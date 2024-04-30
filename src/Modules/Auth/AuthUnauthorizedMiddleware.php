<?php


namespace AuthManao\Modules\Auth;


use AuthManao\Kernel\Router\Middleware;
use AuthManao\Kernel\Router\Request;

class AuthUnauthorizedMiddleware implements Middleware
{
    public function transform(Request $request)
    {
        session_start();
        if (isset($_SESSION['login'])) {
            header("Location: /");
        }
    }
}