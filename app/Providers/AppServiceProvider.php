<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(
            'kollex\Services\FileServiceInterface',
            'kollex\Services\FileService'
        );

        $this->app->bind(
            'kollex\Services\ProductMapperInterface',
            'kollex\Services\ProductFromAMapper'
        );
    }
}
