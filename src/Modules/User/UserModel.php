<?php


namespace AuthManao\Modules\User;


use AuthManao\Kernel\DataBase\DataBase;

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase('db.json');
    }

    public function create(RegisterUserDTO $user)
    {
        $salt = 'ZbZRWcnKZmx7Gq2v1PcUj3VB8ku6eA4F';
        $password = $salt . md5($user->password);
        $this->db->create([
            'login' => $user->login,
            'password' => $password,
            'email' => $user->email,
            'name' => $user->name
        ]);
    }

    public function find($login, $password)
    {
        $salt = 'ZbZRWcnKZmx7Gq2v1PcUj3VB8ku6eA4F';
        $password = $salt . md5($password);

        $user = $this->db->find(function ($item) use ($login, $password) {
            return $item['login'] === $login && $item['password'] === $password;
        });

        return $user;
    }

    public function findByLogin($login)
    {
        return $this->db->find(function ($item) use ($login) {
            return $item['login'] === $login;
        });
    }
}