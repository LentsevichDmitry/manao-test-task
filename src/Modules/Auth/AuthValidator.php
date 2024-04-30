<?php


namespace AuthManao\Modules\Auth;


use AuthManao\Kernel\Validators\MinLengthValidator;
use AuthManao\Kernel\Validators\NotEmptyValidator;
use AuthManao\Kernel\Validators\ObjectValidator;
use AuthManao\Kernel\Validators\PasswordValidator;
use AuthManao\Kernel\Validators\StringValidator;

class AuthValidator extends ObjectValidator
{
    public function __construct()
    {
        $this->setFields([
                'login' => [
                    new NotEmptyValidator(),
                    new StringValidator(),
                    (new MinLengthValidator())->setMinLength(6),
                ],
                'password' => [
                    new NotEmptyValidator(),
                    new StringValidator(),
                    (new MinLengthValidator())->setMinLength(6),
                    new PasswordValidator(),
                ]
            ]);
    }
}