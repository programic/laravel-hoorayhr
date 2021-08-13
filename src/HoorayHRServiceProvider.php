<?php

namespace Programic\Hooray;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class HoorayHRServiceProvider extends ServiceProvider
{
    public function boot(Filesystem $filesystem)
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(HoorayHR::class, function ($app) {
            return new HoorayHR($app);
        });
    }
}
