<?php

namespace App\Providers;

use App\Mixins\ResponseMixin;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
        $this->app->bind(' App\Domains\Article\Services\ArticleService', function ($app) {
            return new \App\Domains\Article\Services\ArticleService($app->make('App\Domains\Article\Repositories\ArticleRepository'), request()->all());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ResponseFactory::mixin(new ResponseMixin());

    }
}
