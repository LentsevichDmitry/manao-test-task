<?php
namespace AuthManao\Modules\Shared;

use AuthManao\Kernel\Router\Middleware;
use AuthManao\Kernel\Router\Request;

class JSONMiddleware implements Middleware
{

    public function transform(Request $request)
    {
        header('Content-Type: application/json');
    }
}