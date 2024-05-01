<?php

namespace AuthManao\Kernel\DataBase;

use AuthManao\Kernel\HttpException\HTTPInternalServerException;

class DataBase
{
    private $fileName;
    private $data = [];

    public function __construct($fileName)
    {

        $this->fileName = $_SERVER['DOCUMENT_ROOT'] . '/' . $fileName;

        if (!file_exists($this->fileName)) {
            throw new HTTPInternalServerException($fileName . ' file not exists');
        }

        $this->data = json_decode(file_get_contents($this->fileName), true);
    }

    public function findAll()
    {
        return $this->data;
    }

    public function find($callback)
    {
        foreach ($this->data as $item){
            if (call_user_func($callback, $item)){
                return $item;
            }
        }
        return null;
    }

    public function create($item)
    {
        // Добавляем новую запись
        $this->data[] = $item;

        // Кодируем массив обратно в JSON
        $jsonData = json_encode($this->data, JSON_PRETTY_PRINT);

        // Записываем JSON обратно в файл
        file_put_contents($this->fileName, $jsonData);
    }

}
