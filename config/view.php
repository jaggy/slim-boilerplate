<?php

return [
    'path' => __DIR__ . '/../resources/views',
    'twig' => [
        'cache'       => __DIR__ . '/../storage/cache/twig',
        'debug'       => getenv('APP_DEBUG'),
        'auto_reload' => true,
    ],
];
