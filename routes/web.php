<?php

use App\Controllers\UserController;
use App\Controllers\CertificateController;
use App\Resolvers\ControllerResolver;

$router = new \Bramus\Router\Router();

$router->get('/', function () {
    return ControllerResolver::resolve(UserController::class, 'showLoginForm');
});

$router->post('/login', function () {
    return ControllerResolver::resolve(UserController::class, 'login');
});

$router->get('/register', function () {
    return ControllerResolver::resolve(UserController::class, 'showRegistrationForm');
});

$router->post('/register', function () {
    return ControllerResolver::resolve(UserController::class, 'register');
});

$router->get('/certificates', function () {
    return ControllerResolver::resolve(CertificateController::class, 'index');
});

$router->post('/certificates', function () {
    return ControllerResolver::resolve(CertificateController::class, 'store');
});

$router->post('/certificates/remove', function () {
    return ControllerResolver::resolve(CertificateController::class, 'remove');
});

$router->run();
