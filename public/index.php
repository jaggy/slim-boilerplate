<?php

require_once dirname(__DIR__) . '/config/bootstrap.php';

$slim = require '../config/slim.php';

$slim->get('/', function() {
    echo 'Hello World!';
});

$slim->run();