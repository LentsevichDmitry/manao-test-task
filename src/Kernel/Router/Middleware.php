<?php


namespace AuthManao\Kernel\Router;


interface Middleware
{
    public function transform(Request $request);
}