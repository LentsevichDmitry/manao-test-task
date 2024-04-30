<?php


namespace AuthManao\Kernel\HttpException;


class HTTPInternalServerException extends HTTPException
{
    public function __construct($message, $code = 500)
    {
        parent::__construct($message, $code);
    }
}