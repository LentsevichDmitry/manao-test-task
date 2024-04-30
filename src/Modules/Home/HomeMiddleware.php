<?php


namespace AuthManao\Modules\Home;


use AuthManao\Kernel\Router\Middleware;
use AuthManao\Kernel\Router\Request;
use AuthManao\Modules\User\UserModel;

class HomeMiddleware implements Middleware
{

    public function transform(Request $request)
    {
        session_start();
        $login = $_SESSION['login'] ?? null;

        if ($login) {
            $userModel = new UserModel();
            $request->body = $userModel->findByLogin($login);
        }
    }
}