<?php

require 'vendor/autoload.php';
require 'helpers.php';

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Compilers\BladeCompiler;
use Dotenv\Dotenv;

session_start();

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app = new Container();
$app->instance('config', require __DIR__ . '/config/database.php');
$app->instance('events', new Dispatcher($app));

$fileSystem = new Filesystem();
$viewFinder = new FileViewFinder($fileSystem, [__DIR__ . '/app/Views']);

$engineResolver = new EngineResolver();

$engineResolver->register('php', function () use ($fileSystem) {
    return new PhpEngine($fileSystem);
});

$cachePath = __DIR__ . '/storage/framework/views';
$bladeCompiler = new BladeCompiler($fileSystem, $cachePath);
$engineResolver->register('blade', function () use ($bladeCompiler) {
    return new CompilerEngine($bladeCompiler);
});

$viewFactory = new Factory($engineResolver, $viewFinder, $app->make('events'));
$app->instance('view', $viewFactory);

function app($abstract = null)
{
    global $app;
    return is_null($abstract) ? $app : $app->make($abstract);
}

function view($view, $data = [])
{
    echo app('view')->make($view, $data)->render();
    setSession('error', '');
    setSession('success', '');
}


require 'Resolvers/ControllerResolver.php';
require 'routes/web.php';
