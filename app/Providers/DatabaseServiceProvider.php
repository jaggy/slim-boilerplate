<?php

namespace App\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface as ServiceProvider;
use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseServiceProvider implements ServiceProvider
{
    /**
     * Register twig's config to the container.
     *
     * @param  Container  $container
     * @return void
     */
    public function register(Container $container)
    {
        app()->bind('database', function ($container) {
            $capsule = new Capsule;
            $capsule->addConnection(config('database'));

            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            return $capsule;
        });
    }
}
