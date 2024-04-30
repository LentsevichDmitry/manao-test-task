<?php

namespace AuthManao\Kernel\Router;

class Request
{
    public $body;
    public $query;

    function __construct($body, $query)
    {
        $this->body = $body;
        $this->query = $query;
    }

}