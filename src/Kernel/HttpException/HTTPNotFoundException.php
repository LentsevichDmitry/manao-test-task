<?php


namespace AuthManao\Kernel\HttpException;


class HTTPNotFoundException extends HTTPException
{
    public function __construct($message, $code = 404)
    {
        parent::__construct($message, $code);
    }
}