<?php

use App\Controllers\UserController;
use App\Controllers\CertificateController;
use App\Resolvers\ControllerResolver;

$router = new \Bramus\Router\Router();

$router->get('/', function () {
    return ControllerResolver::resolve(UserController::class, 'showLoginForm');
});

$router->get('/logout', function () {
    setSession('id', '');
    redirect('/');
});

$router->get('/register', function () {
    return ControllerResolver::resolve(UserController::class, 'showRegistrationForm');
});

$router->get('/myaccount', function () {
    return ControllerResolver::resolve(UserController::class, 'showMyAccountForm');
});

$router->get('/certificates', function () {
    return ControllerResolver::resolve(CertificateController::class, 'index');
});

$router->post('/login', function () {
    return ControllerResolver::resolve(UserController::class, 'login');
});

$router->post('/register', function () {
    return ControllerResolver::resolve(UserController::class, 'register');
});

$router->post('/myaccount', function () {
    return ControllerResolver::resolve(UserController::class, 'myAccount');
});

$router->post('/certificates/remove', function () {
    return ControllerResolver::resolve(CertificateController::class, 'remove');
});

$router->post('/certificates', function () {

    try {
        $idUser = session('id');
        $targetDir = "./storage/uploads/";
        $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
        $timeNow = time();
        $imageName = "{$idUser}-{$timeNow}.{$imageFileType}";
        $targetFile = $targetDir . $imageName;

        $allowedFormats = ["jpg", "jpeg", "png", "pdf", "webp"];

        if (
            in_array($imageFileType, $allowedFormats) &&
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)
        ) {
            $certificateController = new CertificateController();
            $certificateController->store($imageName);
            setSession('success', 'success');
        } else {
            setSession('error', 'error');
        }
    } catch (\Exception $e) {
        setSession('error', $e->getMessage());
    }

    return ControllerResolver::resolve(CertificateController::class, 'index');
});

$router->run();
