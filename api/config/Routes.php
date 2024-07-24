<?php
namespace Config;

use Config\Request;
use Exception;

class Routes
{
    private $routes = [];

    public function __construct()
    {
        $this->routes = [
            'GET' => [],
            'POST' => [],
            'PUT' => [],
            'DELETE' => []
        ];
    }

    public function get($route, $callback)
    {
        $this->routes['GET'][$route] = $callback;
    }

    public function post($route, $callback)
    {
        $this->routes['POST'][$route] = $callback;
    }

    public function put($route, $callback)
    {
        $this->routes['PUT'][$route] = $callback;
    }

    public function delete($route, $callback)
    {
        $this->routes['DELETE'][$route] = $callback;
    }

    public function respuesta()
    {
        try {
            $request = new Request();
            $method = $request->getMethod();
            $uri = $request->getUri();
            $baseUri = '/gestion_tareas_api';
            $normalizedUri = str_replace($baseUri, '', $uri);
    
            if (array_key_exists($normalizedUri, $this->routes[$method])) {
                call_user_func($this->routes[$method][$normalizedUri]);
            } else {
                throw new Exception('Endpoint no funciona', 404);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(['mensaje' => $e->getMessage()]);
        }
    }
}
