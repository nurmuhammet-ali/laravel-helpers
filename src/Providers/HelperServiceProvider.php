<?php

namespace Nurmuhammet\Helpers\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;

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
		Response::macro('rest', function (array $data = [], int $status_code = 200, string $message = 'success') {
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
        Response::macro('rest_paginate', function (Paginator $data, int $status_code = 200, string $message = 'success') {
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
	}

	public function setAuthorizationHelpers(): void
	{
		Gate::define('is-me', fn ($user) => $user->email == 'nurmuhammet@mail.com');
	}
}