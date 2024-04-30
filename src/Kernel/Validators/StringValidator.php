<?php

namespace AuthManao\Kernel\Validators;

use AuthManao\Kernel\HttpException\HTTPBadRequestException;

class StringValidator implements Validator
{

    public function validate($value)
    {
        if (!is_string($value)) {
            throw new HTTPBadRequestException("$value should be string");
        }
    }
}