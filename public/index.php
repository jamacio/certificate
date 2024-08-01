<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Jenssegers\Blade\Blade;

$views = __DIR__ . '/../resources/views';
$cache = __DIR__ . '/../storage/cache';
$blade = new Blade($views, $cache);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/certificates') {
    require_once __DIR__ . '/../src/Controllers/CertificateController.php';
    $controller = new CertificateController($blade);
    echo $controller->index();
} elseif ($uri === '/login') {
    require_once __DIR__ . '/../src/Controllers/AuthController.php';
    $controller = new AuthController($blade);
    echo $controller->login();
} elseif ($uri === '/register') {
    require_once __DIR__ . '/../src/Controllers/AuthController.php';
    $controller = new AuthController($blade);
    echo $controller->register();
} elseif ($uri === '/myaccount') {
    require_once __DIR__ . '/../src/Controllers/AccountController.php';
    $controller = new AccountController($blade);
    echo $controller->index();
} else {
    echo $blade->render('404');
}
