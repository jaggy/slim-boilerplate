<?php

use Slim\Slim;
use Slim\Views\Twig;

$app = new Slim([
    'view' => new Twig
]);

$view = $app->view;

/**
 * Set the template location
 */
$view->setTemplatesDirectory(APP_ROOT . DS . 'app' . DS . 'views');


$view->parserOptions = [
    'debug' => true,
    'cache' => APP_ROOT . DS . 'tmp' . DS . 'twig'
];

return $app;
