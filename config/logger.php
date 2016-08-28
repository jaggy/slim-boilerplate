<?php

use Monolog\Logger;

return [
    'name'  => getenv('APP_NAME'),
    'path'  => __DIR__ . '/../storage/logs/app.log',
    'level' => Logger::DEBUG,
];
