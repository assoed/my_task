<?php
require '../src/Controllers/ProductController.php';
require '../src/Loaders/FileCSVLoader.php';
require '../src/Loaders/FileXMLLoader.php';
require '../src/Loaders/FileProductLoaderCSV.php';
require '../src/Loaders/FileProductLoaderXML.php';
require '../src/Creators/ProductCreator.php';
require '../src/Validator/SchemeValidator/ProductSchemeValidator.php';
require '../src/Models/ProductModel.php';
require '../src/Loaders/POSTProductLoader.php';
require '../src/Loaders/POSTLoader.php';
require '../src/Validator/ProductValidator/ProductValidator.php';
require '../src/Cleaners/ProductCleaner.php';
 require '../src/Converters/ProductUTF8Converter.php';
use Controllers\ProductController;

$filepath='/dataCSV.csv';
$productController = new ProductController();
//var_dump($_SERVER['REQUEST_METHOD'] );die;
var_dump($_GET);die;
//dataType post || xml || csv
$productsStatus = $productController->getRequestStatus('post',$filepath);

echo json_encode($productsStatus);