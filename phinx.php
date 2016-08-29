<?php

require __DIR__ . '/vendor/autoload.php';

(new Dotenv\Dotenv(__DIR__))->load();

return [
    'paths' => [
        'migrations' => 'database/migrations',
        'seeds' => 'database/seeds',
    ],

    'environments' => [
        'default_migrations_table' => 'migrations',
        'default_database' => env('DB_CONNECTION', 'mysql'),

        'mysql' => [
            'adapter' => 'mysql',
            'host' => env('DB_HOST', 'localhost'),
            'name' => env('DB_NAME', 'homestead'),
            'user' => env('DB_USER', 'homestead'),
            'pass' => env('DB_PASS', 'secret'),
            'port' => env('DB_PORT', 3306),
            'charset' => 'utf8'
        ]
    ]
];
