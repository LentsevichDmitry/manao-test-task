<?php


namespace AuthManao\Kernel\HttpException;


class HTTPBadRequestException extends HTTPException
{
    public function __construct($message, $code = 400)
    {
        parent::__construct($message, $code);
    }
}