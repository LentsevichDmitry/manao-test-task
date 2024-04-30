<?php


namespace AuthManao\Modules\Auth;

use AuthManao\Kernel\Router\Middleware;
use AuthManao\Kernel\Router\Request;

class AuthMiddleware implements Middleware
{
    function transform(Request $request)
    {
        $authDTO = new AuthDTO(
            $request->body['login'],
            $request->body['password']
        );

        $authValidator = new AuthValidator();

        $authValidator->validate($authDTO);

        $request->body = $authDTO;
    }
}