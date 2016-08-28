<?php

namespace App\Providers;

use Monolog\Logger as Monolog;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;
use Pimple\Container;
use Pimple\ServiceProviderInterface as ServiceProvider;

class MonologServiceProvider implements ServiceProvider
{
    /**
     * Register twig's config to the container.
     *
     * @param  Container  $container
     * @return void
     */
    public function register(Container $container)
    {
        $container['logger'] = function ($container) {
            $stream = new StreamHandler(
                config('logger.path'),
                config('logger.level')
            );

            $logger = $this->newLogger();
            $logger->pushProcessor(new UidProcessor);
            $logger->pushHandler($stream);

            return $logger;
        };
    }

    /**
     * Create a new logger instance.
     *
     * @return Monolog
     */
    private function newLogger()
    {
        return new Monolog(config('logger'));
    }
}
