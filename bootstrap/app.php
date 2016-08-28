<?php

use App\Application;

$app = new Application(__DIR__ . '/../');

Application::setInstance($app);

// Register middleware
require __DIR__ . '/middleware.php';

// Register routes
require __DIR__ . '/../app/Http/routes.php';

return $app;

