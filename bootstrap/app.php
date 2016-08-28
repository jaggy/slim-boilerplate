<?php

use App\Application;

$app = new Application(__DIR__ . '/../');

Application::setInstance($app);

// Register the service providers.
$app->registerServiceProviders();

// Register the middleware
require __DIR__ . '/middleware.php';

// Register the routes
require __DIR__ . '/../app/Http/routes.php';

return $app;

