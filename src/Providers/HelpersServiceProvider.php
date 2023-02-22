<?php

namespace Nurmuhammet\Helpers\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{
	public function boot(): void
	{
		$this->setResponseHelpers();
		$this->setQueryBuilderHelpers();
		$this->setAuthorizationHelpers();
	}

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
	     * @return void
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
	     * @return void
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

	public function setQueryBuilderHelpers(): void
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
	     * Get table name for model
	     * 
	     * Post::tableName() -> posts
	     *
	     * @return string
	     */
		Builder::macro('tableName', fn (): string => (new $this->model)->getTable());

		/**
	     * Get table coloumns for model
	     * 
	     * Post::getColumns() -> posts
	     *
	     * @return array
	     */
		Builder::macro('getColumns', fn (): array => Schema::getColumnListing((new $this->model)->getTable()));
	}

	public function setAuthorizationHelpers(): void
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
}
