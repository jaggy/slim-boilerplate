<?php

use App\Application;
use Slim\Http\Response;

if (! function_exists('app')) {
    /**
     * Return the container.
     *
     * @return mixed
     */
    function app($abstract = null)
    {
        $application = Application::getInstance();

        if (! $abstract) {
            return $application;
        }

        return $application->getContainer()[$abstract];
    }
}

if (! function_exists('view')) {
    /**
     * Return the view.
     *
     * @param  string  $template
     * @param  array  $data
     * @return mixed
     */
    function view($template = null, array $data = [])
    {
        $view = app('view');

        if (! $template) {
            return $view;
        }

        $template = str_replace('.', '/', $template);

        return $view->render(
            new Response,
            str_replace('.', '/', $template) . '.twig',
            $data
        );
    }
}


if (! function_exists('config')) {
    /**
     * Fetch the config array.
     *
     * @return void
     */
    function config($key)
    {
        $segments = explode('.', $key);

        $file   = array_shift($segments);
        $config = require __DIR__ . "/../../config/{$file}.php";

        if (! $segments) {
            return $config;
        }

        $pointer = $config;

        foreach ($segments as $segment) {
            $pointer = $pointer[$segment];
        }

        return $pointer;
    }
}
