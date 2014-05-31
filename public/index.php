<?php

require_once dirname(__DIR__) . '/config/bootstrap.php';

use Router\Router;

$slim   = require APP_ROOT . DS . 'config' . DS . 'slim.php';
$router = new Router($slim);

$router->get('/', 'Site@home');

$slim->run();