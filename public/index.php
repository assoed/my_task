<?php
require_once '../vendor/autoload.php';
use App\Controllers\Router;
use App\Loggers\ProductLogger;
use App\Exceptions\AppException;

$router = new Router();

require_once '../routes.php';
$currentUrl = $_SERVER['REQUEST_URI'];

$method = $_SERVER['REQUEST_METHOD'];
$queryString = file_get_contents('php://input');
parse_str($queryString,$data);

try {
    $router->handleRequest($currentUrl, $method,$data);
}
    catch (AppException $e){
        $productLogger = new ProductLogger();
        $productLogger->logProductErrors($e);
}


