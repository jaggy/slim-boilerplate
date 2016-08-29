<?php

use App\Application;

$app = new Application(__DIR__ . '/../');

Application::setInstance($app);

// Register the service providers.
$app->registerServiceProviders();

// Register the middleware
require __DIR__ . '/middleware.php';

return $app;

