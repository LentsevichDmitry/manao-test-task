<?php

namespace AuthManao\Modules\User;

use AuthManao\Kernel\Router\Request;

class UserController
{
    public function register(Request $request)
    {
        http_response_code(201);
        $userModel = new UserModel();
        $userModel->create($request->body);
    }
}

