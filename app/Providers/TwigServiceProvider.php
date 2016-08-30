<?php

namespace App\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface as ServiceProvider;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Twig_Extension_Debug;

class TwigServiceProvider implements ServiceProvider
{
    /**
     * Register twig's config to the container.
     *
     * @param  Container  $container
     * @return void
     */
    public function register(Container $container)
    {
        app()->bind('view', function ($container) {
            $view = $this->newTwigEngine(config('view.path'), config('view.twig'));

            $view->addExtension(new Twig_Extension_Debug);
            $view->addExtension(new TwigExtension(
                $container->get('router'),
                $container->get('request')->getUri()
            ));

            return $view;
        });
    }

    /**
     * Create a new twig handler.
     *
     * @param  string  $viewDirectory
     * @param  array  $settings
     * @return Twig
     */
    public function newTwigEngine($viewDirectory, array $settings)
    {
        return new Twig($viewDirectory, $settings);
    }
}
