<?php

require_once dirname(__DIR__) . '/config/bootstrap.php';

$slim = require APP_ROOT . DS . 'config' . DS . 'slim.php';

$slim->get('/', function() use ($slim) {
    $slim->render('site/index.twig');
});

$slim->run();