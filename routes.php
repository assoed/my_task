<?php

use App\Controllers\Router;

$router = new Router();
$router->addRoute('#^/products/(\d+)#', 'GET', 'ProductController', 'getProductById');
$router->addRoute('#^/products/(\d+)#', 'PUT', 'ProductController', 'updateProduct');
$router->addRoute('#^/products/(\d+)#', 'PATCH', 'ProductController', 'updateProduct');
$router->addRoute('#^/products/(\d+)#', 'DELETE', 'ProductController', 'deleteProduct');
$router->addRoute('#^/products/$#', 'POST', 'ProductController', 'addProduct');
$router->addRoute('#^/products/$#', 'GET', 'ProductController', 'getAllProducts');
$router->addRoute('#^/products/my$#', 'GET', 'ProductController', 'getUsersProducts');