<?php


namespace AuthManao\Kernel\Validators;

use AuthManao\Kernel\HttpException\HTTPBadRequestException;

class PasswordValidator implements Validator
{
    //Функция для проверки пароля на обязательное наличие цифр и чисел
    public function validate($value)
    {
        if (!preg_match('/[a-z]/', $value) || !preg_match('/[0-9]/', $value)) {
            throw new HTTPBadRequestException('should consists letters and numbers');
        }
    }
}