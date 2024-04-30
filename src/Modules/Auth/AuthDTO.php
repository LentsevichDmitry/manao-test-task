<?php


namespace AuthManao\Modules\Auth;

class AuthDTO
{
    public $login;
    public $password;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }
}