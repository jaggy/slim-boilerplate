<?php
session_start();

require_once dirname(__DIR__) . '/app/config/bootstrap.php';

$slim      = require APP_ROOT . '/app/config/slim.php';
$container = require APP_ROOT . '/app/config/dependencies.php';
$session   = new lib\utility\Session;


/*
|--------------------------------------------------------------------------
| Routing Setup
|--------------------------------------------------------------------------
*/
$router = new router\Router($slim);
$router->setContainer($container);
$router->setSession($session);


/*
|--------------------------------------------------------------------------
| ROUTES
|--------------------------------------------------------------------------
*/
$router->get('/', 'Site@home');


/*
|--------------------------------------------------------------------------
| Application
|--------------------------------------------------------------------------
*/
$slim->run(); // run the application
