<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$basePath = $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__);

$routesCache = $basePath.'/bootstrap/cache/routes-v7.php';
if (is_file($routesCache)) {
    $routesContent = @file_get_contents($routesCache);
    if ($routesContent === false || ! str_contains($routesContent, 'pos-systems-in-kenya-news')) {
        @unlink($routesCache);
    }
}

$configCache = $basePath.'/bootstrap/cache/config.php';
if (is_file($configCache)) {
    $configContent = @file_get_contents($configCache);
    if ($configContent === false || ! str_contains($configContent, 'pos-system-boutique-fashion-kenya')) {
        @unlink($configCache);
    }
}

$app = new Illuminate\Foundation\Application(
    $basePath
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
