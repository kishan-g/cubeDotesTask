<?php

namespace Modules\Post\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Post\Interfaces\PostInterface;
use Modules\Post\Repositories\PostRepository;

class InterfaceBinderServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            $this->app->bind(
                PostInterface::class,
                PostRepository::class
            )
        ];
    }
}
