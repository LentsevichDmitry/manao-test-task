<?php

namespace AuthManao\Modules\User;

class RegisterUserDTO
{
    public $login;
    public $password;
    public $confirmPassword;
    public $email;
    public $name;

    function __construct($login, $password, $confirmPassword, $email, $name)
    {
        $this->login = $login;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->email = $email;
        $this->name = $name;
    }
}
