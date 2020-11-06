<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Post\Interfaces\PostInterface;
use Modules\Post\Repositories\PostRepository;

class InterfaceBinderServiceProvider extends ServiceProvider
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
        $this->app->bind(
            PostInterface::class,
            PostRepository::class
        );
    }
}
