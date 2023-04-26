<?php

namespace Nurmuhammet\Helpers\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class HelpersServiceProvider extends ServiceProvider
{
	public function boot(): void
	{
        $this->setConfigs();
		$this->setResponseHelpers();
		$this->setQueryBuilderHelpers();
		$this->setAuthorizationHelpers();
        $this->setRoutes();
	}

    /**
     * Set configs for the app
     *
     * config('helpers.app')
     *
     * @return void
     */
    protected function setConfigs(): void
    {
        $this->publishes([
            __DIR__.'/../../config/helpers.php' => config_path('helpers.php'),
            'helpers-config'
        ]);

        $this->mergeConfigFrom(__DIR__.'/../../config/helpers.php', 'helpers');
    }

    /**
     * Response helpers
     *
     * Response::rest()
     * Response::rest_paginate()
     *
     * @return void
     */
	protected function setResponseHelpers(): void
	{
		/**
	     * Makes json responses more clean, pragmatic
	     * 
	     * # In method
	     * response()->rest(Product::all())
	     * response()->rest([], 201)
	     * response()->rest([], 201, 'created resource')
	     *
	     * @return \Illuminate\Http\JsonResponse
	     */
		Response::macro('rest', function (mixed $data = [], int $status_code = 200, string $message = 'success') {
            return response()->json(['message' => $message, 'data' => $data], $status_code);
        });

		/**
	     * Makes json paginated responses more clean, pragmatic
	     * 
	     * # In method
	     * response()->rest_paginate(Product::paginate(20))
	     *
	     * @return \Illuminate\Http\JsonResponse
	     */
        Response::macro('rest_paginate', function (mixed $data, int $status_code = 200, string $message = 'success') {
            return response()->json([
                'message' => $message,
                'data' => $data->items(),
                'pagination' => [
                    'current_page' => $data->currentPage(),
                    'first_page_url' => $data->url(1),
                    'next_page_url' => $data->nextPageUrl(),
                    'prev_page_url' => $data->previousPageUrl(),
                ]
            ], $status_code);
        });
	}

    /**
     * Query builder helpers
     *
     * Model::orderByTranslation()
     * Model::paginateRawQuery()
     * Model::tableName()
     * Model::getColumns()
     *
     * @return void
     */
	protected function setQueryBuilderHelpers(): void
	{
		/**
	     * Provides ordering by translations for spatie translatable 
	     * Supported databases: ['postgres']
	     * 
	     * Post::orderByTranslation()->get()
	     *
	     * @return \Illuminate\Database\Eloquent\Builder
	     */
		Builder::macro('orderByTranslation', function ($field, $order = 'asc', $locale = null) {
            if (
                in_array(\Spatie\Translatable\HasTranslations::class, class_uses($this->model))
                && in_array($field, $this->model->translatable)
                && config('database.default') == 'pgsql'
            ) {
                $locale = $locale ?? app()->getLocale();
                $this->query->orderByRaw("$field->>'$locale' $order");
            } else {
                $this->query->orderBy($field, $order);
            }

            return $this;
        });

        /**
	     * Helps to paginate by raw query, but make sure count named "aggregate"
	     * 
	     * Post::paginateRawQuery("select * from posts", ...)
	     *
	     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	     */
	    Builder::macro('paginateRawQuery', function (string $rawQuery, ?int $perPage = null, array $columns = ['*'], string $pageName = 'page', ?int $page = null) {
        	$page = $page ?: Paginator::resolveCurrentPage($pageName);

	        $perPage = $perPage ?: $this->model->getPerPage();

	        $total = DB::select($rawQuery)[0]->aggregate;
	        $results = $total 
	        			? $this->forPage($page, $perPage)->get($columns)
						: $this->model->newCollection();

	        return $this->paginator($results, $total, $perPage, $page, [
	            'path' => Paginator::resolveCurrentPath(),
	            'pageName' => $pageName,
	        ]);    
        });

        /**
	     * Get table name for model
	     * 
	     * Post::tableName() -> posts
	     *
	     * @return string
	     */
		Builder::macro('tableName', fn (): string => (new $this->model)->getTable());

		/**
	     * Get table coloumns for model, caches the result for 5 minutes by default
	     * 
	     * Post::getColumns() -> ['id', 'name', 'slug', ...]
	     * Post::getColumns(cache: false) -> ['id', 'name', 'slug', ...]
	     * Post::getColumns(cacheSeconds: false) -> ['id', 'name', 'slug', ...]
	     *
	     * @return array
	     */
		Builder::macro('getColumns', function (bool $cache = true, int $cacheSeconds = 60 * 5): array {
			$tableName = (new $this->model)->getTable();

			return Cache::remember('table_'.$tableName, $cacheSeconds, fn () => Schema::getColumnListing($tableName));
		});
	}

    /**
     * Authorization helpers
     *
     * Gate::check('is-me')
     */
	protected function setAuthorizationHelpers(): void
	{
		/**
	     * Add gate permission for me
	     * 
	     * Gate::check('is-me', $user) -> response()->allow()
	     *
	     * @return \Illuminate\Database\Eloquent\Builder
	     */
		Gate::define('is-me', fn ($user) => $user->email == 'nurmuhammet@mail.com');
	}

    /**
     * Package Routes
     */
    protected function setRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/helper-routes.php');
    }
}
