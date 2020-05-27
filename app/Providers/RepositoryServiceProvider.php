<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\AnimalsRepository::class, \App\Repositories\AnimalsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AnimalsRepository::class, \App\Repositories\AnimalsRepositoryEloquent::class);
        //:end-bindings:
    }
}
