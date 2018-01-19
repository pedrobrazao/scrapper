<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Scrapper\ScrapperService;
use Scrapper\ScrapperServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ScrapperServiceInterface::class, function($app) {
            return new ScrapperService();
        });
    }
}
