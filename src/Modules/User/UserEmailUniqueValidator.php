<?php


namespace AuthManao\Modules\User;


use AuthManao\Kernel\DataBase\DataBase;
use AuthManao\Kernel\Validators\UniqueValidator;

class UserEmailUniqueValidator extends UniqueValidator
{
    public function __construct()
    {
        $db = new DataBase('db.json');

        $this->configure($db->findAll(), function ($item, $value){
            return $item['email'] === $value;
        });
    }

}