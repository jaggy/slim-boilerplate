<?php

namespace App;

use Closure;
use Slim\App as Slim;
use Dotenv\Dotenv;

class Application
{
    /**
     * Router instance.
     *
     * @var Slim
     */
    private $router;

    /**
     * Instance of the application.
     *
     * @var Application
     */
    private static $instance;

    /**
     * Create a new application instance.
     *
     * @param  string  $basepath  The path of the root.
     * @return Application
     */
    public function __construct($basepath)
    {
        $this->loadEnvironmentVariables($basepath);

        $this->router = $this->newRouter();
    }

    /**
     * Bind the abstract to a concrete implementation.
     *
     * @param  string  $abstract
     * @param  Closure  $concrete
     * @return void
     */
    public function bind($abstract, Closure $concrete)
    {
        $container = $this->router->getContainer();

        $container[$abstract] = $concrete;
    }

    /**
     * Register the service providers.
     *
     * @return void
     */
    public function registerServiceProviders()
    {
        $container = $this->router->getContainer();
        $providers = config('app.providers');

        array_walk($providers, function ($provider) use ($container) {
            $container->register(new $provider);
        });
    }

    /**
     * Return the router instance.
     *
     * @return Slim
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * Set the applicaiton instance.
     *
     * @param  Application  $application
     * @return void
     */
    public static function setInstance(Application $application)
    {
        static::$instance = $application;
    }

    /**
     * Return the instnace.
     *
     * @return Application
     */
    public static function getInstance()
    {
        return static::$instance;
    }

    /**
     * Create our base router.
     *
     * @return Slim
     */
    private function newRouter()
    {
        return new Slim([
            'settings' => [
                'displayErrorDetails'    => config('app.debug'),
                'addContentLengthHeader' => false,
            ],
        ]);
    }

    /**
     * Load the project environment variables.
     *
     * @return void
     */
    private function loadEnvironmentVariables($path)
    {
        (new Dotenv($path))->load();
    }

    /**
     * Call the routing method if it exists.
     *
     * @param  string  $method
     * @param  array  $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->router, $method], $arguments);
    }
}
