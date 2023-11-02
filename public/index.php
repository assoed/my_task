<?php
require '../src/Controllers/ProductController.php';
require '../src/Loaders/FileCSVLoader.php';
require '../src/Loaders/FileXMLLoader.php';
require '../src/Loaders/FileProductLoaderCSV.php';
require '../src/Loaders/FileProductLoaderXML.php';
require '../src/Creators/ProductCreator.php';
require '../src/Validator/SchemeValidator/ProductSchemeValidator.php';
require '../src/Controllers/Router.php';
require '../src/Loaders/POSTProductLoader.php';
require '../src/Validator/ProductValidator/ProductValidator.php';
require '../src/Cleaners/ProductCleaner.php';
require '../src/Converters/ProductUTF8Converter.php';
require '../src/Models/ProductModel.php';
require '../src/Exceptions/AppException.php';
require '../src/Entity/Product.php';
use Controllers\Router;
use Loaders\POSTProductLoader;
use Validator\SchemeValidator\ProductSchemeValidator;
use Controllers\ProductController;

//у меня возникла проблема с подключением файла routes.php, поэтом пока сделал так. потом исправлю.
$router = new Router();
$router->addRoute('#^/products/(\d+)#', 'GET', 'ProductController', 'getProductById');
$router->addRoute('#^/products/(\d+)#', 'PUT', 'ProductController', 'updateProduct');
$router->addRoute('#^/products/(\d+)#', 'PATCH', 'ProductController', 'updateProductParam');
$router->addRoute('#^/products/(\d+)#', 'DELETE', 'ProductController', 'deleteProduct');
$router->addRoute('#^/products/#', 'POST', 'ProductController', 'addProduct');
$router->addRoute('#^/products/#', 'GET', 'ProductController', 'getAllProducts');
$router->addRoute('#^/products/my#', 'GET', 'ProductController', 'getUsersProducts');


$schemeValidator = new ProductSchemeValidator();

$currentUrl = $_SERVER['REQUEST_URI'];

$method = $_SERVER['REQUEST_METHOD'];
$POSTProductLoader = new POSTProductLoader($schemeValidator);

$product = $POSTProductLoader->getProductFromPost();

$router->handleRequest($currentUrl, $method,$product);