<?php

namespace Controllers;
//require 'ProductController.php';
require 'View.php';
use Controllers\ProductController;

use Exceptions\AppException;
use Loaders\POSTProductLoader;
use Models\ProductModel;
use mysql_xdevapi\Exception;
use Validator\ProductValidator\ProductValidator;
use Validator\SchemeValidator\ProductSchemeValidator;
use Controllers\View;

class Router
{
    private array $routes = [];

    public function addRoute(string $pattern, string $method, string $controller, string $action):void
    {
        $this->routes[$pattern][$method] = ['controller' => $controller, 'action' => $action];
    }

    public function handleRequest(string $url, string $method,$data):void
    {

        $productValidator = new ProductValidator();
        $productModel = new ProductModel();
        $view = new View();
        $isPageFound = false;
        foreach ($this->routes as $pattern => $methods) {

            if (preg_match($pattern, $url, $matches) && isset($methods[$method])) {
                $route = $methods[$method];
//                $controller = $route['controller'];
                $action = $route['action'];
                $controllerInstance = new ProductController($productValidator,$view,$productModel,$data);
                $controllerInstance->$action($matches[0]);
                $isPageFound = true;

            }

        }
        if(!$isPageFound){
            throw new AppException('Page not found',404);
        }
 ;
    }
}