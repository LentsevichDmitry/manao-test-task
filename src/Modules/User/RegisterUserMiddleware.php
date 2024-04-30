<?php

namespace AuthManao\Modules\User;

use AuthManao\Kernel\Router\Middleware;
use AuthManao\Kernel\Router\Request;

class RegisterUserMiddleware implements Middleware
{

    function transform(Request $request)
    {
        $userDTO = new RegisterUserDTO(
            $request->body['login'],
            $request->body['password'],
            $request->body['confirm_password'],
            $request->body['email'],
            $request->body['name']
        );

        $userValidator = new RegisterUserValidator();

        $userValidator->validate($userDTO);

        $request->body = $userDTO;
    }

}

