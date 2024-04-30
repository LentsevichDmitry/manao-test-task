<?php

namespace AuthManao\Kernel\Router;

use AuthManao\Kernel\HttpException\HTTPException;
use AuthManao\Kernel\HttpException\HTTPInternalServerException;
use AuthManao\Kernel\HttpException\HTTPNotFoundException;

class Router
{
    private $routes = [
        'GET' => [],
        'POST' => [],
        'PATCH' => [],
        'DELETE' => [],
    ];


    function get(string $routePath, ...$funcs)
    {
        $this->addRoute('GET', $routePath, $funcs);
    }

    function post(string $routePath, ...$funcs)
    {
        $this->addRoute('POST', $routePath, $funcs);
    }

    function patch(string $routePath, ...$funcs)
    {
        $this->addRoute('PATCH', $routePath, $funcs);
    }

    function delete(string $routePath, ...$funcs)
    {
        $this->addRoute('DELETE', $routePath, $funcs);
    }

    private function addRoute($method, string $path, array $funcs)
    {
        $this->routes[$method][$path] = $funcs;
    }

    function execute()
    {
        try {
            $request = new Request($_POST, $_GET);
            $method = $_SERVER['REQUEST_METHOD'];
            $path = $_SERVER['REQUEST_URI'];

            if (
                !key_exists($method, $this->routes)
                || !$this->routes[$method]
                || !key_exists($path, $this->routes[$method])
                || !$this->routes[$method][$path]
            ) {
                $contentType = '';
                $message = 'Route not found';

                foreach (headers_list() as $header) {
                    if (str_contains($header, 'Content-type')) {
                        $contentType = explode(': ', $header)[1];
                        break;
                    }
                }

                if ($contentType === 'application/json') {
                    $message = json_encode(['error' => $message]);
                }

                throw new HTTPNotFoundException($message);
            }

            $middlewares = $this->routes[$method][$path];
            $result = null;

            foreach ($middlewares as $middleware) {
                $result = $middleware($request);
            }

            echo $result;
        } catch (HttpException $exception) {
            http_response_code($exception->getCode());
            echo $exception->getMessage();
        } catch (\Exception $e) {
            $exception = new HTTPInternalServerException($e->getMessage());
            http_response_code($exception->getCode());
            echo $exception->getMessage();
        }
    }
}