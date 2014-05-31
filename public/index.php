<?php

require_once dirname(__DIR__) . '/config/bootstrap.php';

use Slim\Slim;

$app = new Slim;

$app->get('/', function() {
    echo 'Hello World!';
});

$app->run();