<?php

return [
    'debug' => getenv('APP_DEBUG'),

    'providers' => [
        \App\Providers\TwigServiceProvider::class,
        \App\Providers\MonologServiceProvider::class,
        \App\Providers\DatabaseServiceProvider::class,
        \App\Providers\RouteServiceProvider::class,
    ]
];
