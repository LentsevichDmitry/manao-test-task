<?php

namespace AuthManao\Modules\User;

use AuthManao\Kernel\HttpException\HTTPBadRequestException;
use AuthManao\Kernel\Validators\EmailValidator;
use AuthManao\Kernel\Validators\NotEmptyValidator;
use AuthManao\Kernel\Validators\ObjectValidator;
use AuthManao\Kernel\Validators\PasswordValidator;
use AuthManao\Kernel\Validators\StringValidator;
use AuthManao\Kernel\Validators\MinLengthValidator;

class RegisterUserValidator extends ObjectValidator
{
    function __construct()
    {
        $this->setFields([
            'login' => [
                new NotEmptyValidator(),
                new StringValidator(),
                (new MinLengthValidator())->setMinLength(6),
                new UserLoginUniqueValidator(),
            ],
            'password' => [
                new NotEmptyValidator(),
                new StringValidator(),
                (new MinLengthValidator())->setMinLength(6),
                new PasswordValidator(),
            ],
            'email' => [
                new NotEmptyValidator(),
                new EmailValidator(),
                new UserEmailUniqueValidator(),
            ],
            'name' => [
                new NotEmptyValidator(),
                new StringValidator(),
                (new MinLengthValidator())->setMinLength(2),
            ],
        ]);
    }

    public function validate($value)
    {
        $errors = [];

        try {
            parent::validate($value);
        } catch (\Exception $exception) {
            $errors = json_decode($exception->getMessage(), true);
        } finally {
            if ($value->confirmPassword !== $value->password) {
                $errors['confirm_password'] = 'Confirm password should match password';
            }

            if ($errors) {
                throw new HTTPBadRequestException(json_encode($errors));
            }
        }
    }

}