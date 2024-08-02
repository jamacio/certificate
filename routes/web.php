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

    $idUser = $_SESSION['id'];
    $targetDir = "./storage/uploads/";
    $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
    $timeNow = time();
    $imageName = "{$idUser}-{$timeNow}.{$imageFileType}";
    $targetFile = $targetDir . $imageName;

    $allowedFormats = ["jpg", "jpeg", "png", "pdf", "webp"];
    if (!in_array($imageFileType, $allowedFormats)) {
        $_SESSION['error'] = 'error';
    }

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        $_SESSION['success'] = 'success';

        $certificateController = new CertificateController();
        $certificateController->store($imageName);
    }

    return ControllerResolver::resolve(CertificateController::class, 'index');
});

$router->post('/certificates/remove', function () {
    return ControllerResolver::resolve(CertificateController::class, 'remove');
});

$router->run();
