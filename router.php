<?php

use AuthManao\Kernel\Router\Router;
use AuthManao\Modules\Auth\AuthMiddleware;
use AuthManao\Modules\Auth\AuthUnauthorizedMiddleware;
use AuthManao\Modules\Home\HomeMiddleware;
use AuthManao\Modules\Shared\JSONMiddleware;
use AuthManao\Modules\User\RegisterUserMiddleware;
use AuthManao\Modules\User\UserController;
use AuthManao\Modules\Home\HomeController;
use AuthManao\Modules\Auth\AuthController;

$router = new Router();

$userController = new UserController();
$authController = new AuthController();
$jsonMiddleware = new JSONMiddleware();

$router->get(
    '/',
    [new HomeMiddleware(), 'transform'],
    [new HomeController(), 'getHomePage']
);
$router->get(
    '/auth',
    [new AuthUnauthorizedMiddleware(), 'transform'],
    [$authController, 'getAuthPage']
);

$router->post(
    '/register',
    [$jsonMiddleware, 'transform'],
    [new RegisterUserMiddleware(), 'transform'],
    [$userController, 'register'],
);
$router->post(
    '/auth',
    [$jsonMiddleware, 'transform'],
    [new AuthMiddleware(), 'transform'],
    [$authController, 'auth']
);

$router->execute();


