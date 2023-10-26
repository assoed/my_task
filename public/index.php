<?php
require '../src/Loaders/FileCSVLoader.php';
require '../src/Loaders/FileXMLLoader.php';
require '../src/Loaders/FileProductLoaderCSV.php';
require '../src/Loaders/FileProductLoaderXML.php';
require '../src/Creators/ProductCreator.php';
require '../src/Controllers/ProductController.php';
require '../src/Validator/SchemeValidator/ProductSchemeValidator.php';
require '../src/Models/Product.php';
require '../src/Loaders/POSTProductLoader.php';
require '../src/Loaders/POSTLoader.php';
require '../src/Validator/ProductValidator/ProductValidator.php';
use Creators\ProductCreator;
use Loaders\FileCSVLoader;
use Loaders\FileXMLLoader;
use Loaders\FileProductLoaderCSV;
use Loaders\FileProductLoaderXML;
use Validator\SchemeValidator\ProductSchemeValidator;
use Loaders\POSTProductLoader;
use Loaders\POSTLoader;
use Validator\ProductValidator\ProductValidator;

$productSchemeValidator = new ProductSchemeValidator();
$fileCSVLoader = new FileCSVLoader();
$fileLoaderXML = new FileXMLLoader();
$productCreator = new ProductCreator($productSchemeValidator);
$FileProductLoaderXML = new FileProductLoaderXML($productSchemeValidator,$fileLoaderXML,$productCreator);
$FileProductLoaderCSV = new FileProductLoaderCSV($productSchemeValidator,$fileCSVLoader,$productCreator);
$POSTLoader = new POSTLoader();
$POSTLoader = new POSTProductLoader($productSchemeValidator,$POSTLoader,$productCreator);
//    var_dump($FileProductLoaderXML->load('dataXML.xml'));

//var_dump($FileProductLoaderXML->load('/dataXML.xml'));
//var_dump($POSTLoader->load($_GET));

$productValidator = new ProductValidator();
$validationStatus = $productValidator->validate($FileProductLoaderXML->load('/dataXML.xml'));

var_dump($validationStatus);