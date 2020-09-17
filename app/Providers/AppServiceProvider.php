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
        // $this->app->singleton('App\Domains\SmsGate\Interfaces\SmsGateAdapterInterface', function ($app) {
        //     return new \App\Domains\SmsGate\Adapters\UcellSmsGate;
        // });
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
