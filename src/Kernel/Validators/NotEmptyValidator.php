<?php

namespace AuthManao\Kernel\Validators;

use AuthManao\Kernel\HttpException\HTTPBadRequestException;
use Exception;

class NotEmptyValidator implements Validator
{
    public function validate($value)
    {
        if (empty($value)) {
            throw new HTTPBadRequestException("$value should not be empty");
        }
    }
}