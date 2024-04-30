<?php

namespace AuthManao\Kernel\Validators;

use AuthManao\Kernel\HttpException\HTTPBadRequestException;

class EmailValidator implements Validator
{
    public function validate($value)
    {
        $isValidEmail = filter_var($value, FILTER_VALIDATE_EMAIL);

        if (!$isValidEmail) {
            throw new HTTPBadRequestException("should be correct email");
        }
    }
}