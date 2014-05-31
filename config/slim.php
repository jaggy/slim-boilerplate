<?php

use Slim\Slim;
use Slim\Views\Twig;

$app = new Slim([
    'view' => new Twig
]);

$app->view->parserOptions = [
    'debug' => true,
    'cache' => WEBROOT . DS . 'cache'
];

return $app;
