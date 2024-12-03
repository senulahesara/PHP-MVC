<?php

namespace App\Core;

class Router
{
    private static $getRoutes = [];
    private static $postRoutes = [];
    private static $putRoutes = [];
    private static $deleteRoutes = [];

    public static function get($path, $handler)
    {
        self::$getRoutes[] = [
            'path' => APP_URL . $path,
            'handler' => $handler
        ];
    }

    public static function post($path, $handler)
    {
        self::$postRoutes[] = [
            'path' => APP_URL . $path,
            'handler' => $handler
        ];
    }

    public static function put($path, $handler)
    {
        self::$putRoutes[] = [
            'path' => APP_URL . $path,
            'handler' => $handler
        ];
    }

    public static function delete($path, $handler)
    {
        self::$deleteRoutes[] = [
            'path' => APP_URL . $path,
            'handler' => $handler
        ];
    }

    public static function route($method, $path)
    {
        $routes = array();
        switch ($method) {
            case 'GET':
                $routes = self::$getRoutes;
                break;
            case 'POST':
                $routes = self::$postRoutes;
                break;
            case 'PUT':
                $routes = self::$putRoutes;
                break;
            case 'DELETE':
                $routes = self::$deleteRoutes;
                break;
        }

        foreach ($routes as $route) {
            $pattern = str_replace("/", "\/", $route['path']);
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^\/]+)', $pattern);
            $pattern = '/^' . $pattern . '$/';

            if (preg_match($pattern, $path, $matches)) {
                $index = array_search($route, $routes);
                $handler = $routes[$index]['handler'];
                return $handler($matches);
                break;
            }
        }

        if($path != APP_URL . '/404'){
            redirect('/404');
        }

    }
}
