<?php

namespace App\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface as ServiceProvider;

class RouteServiceProvider implements ServiceProvider
{
    /**
     * Register twig's config to the container.
     *
     * @param  Container  $container
     * @return void
     */
    public function register(Container $container)
    {
        $router = app()->getRouter();

        require __DIR__ . '/../../routes/web.php';
    }
}

