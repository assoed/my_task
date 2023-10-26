<?php
//namespace Controllers;
//use Creators\ProductCreator;
//use Loaders\FileCSVLoader;
//use Loaders\FileXMLLoader;
//use Loaders\FileProductLoaderCSV;
//use Loaders\FileProductLoaderXML;
//use Validator\SchemeValidator\ProductSchemeValidator;
//use Loaders\POSTProductLoader;
//use Loaders\POSTLoader;
//use Validator\ProductValidator\ProductValidator;
//
//class ProductController
//{
//
//    public function handleRequest($dataType){
//        $loader = null;
//        $productValidator = new ProductValidator();
//        $schemeValidator = new ProductSchemeValidator();
//        $productCreator = new ProductCreator($schemeValidator);
//
//        switch ($dataType){
//            case 'csv':
//                $fileCSVLoader = new FileCSVLoader();
//                $loader = new FileProductLoaderCSV($schemeValidator,$fileCSVLoader,$productCreator);
//                break;
//            case 'xml':
//                $fileXMLLoader = new FileXMLLoader();
//                $loader = new FileProductLoaderXML($schemeValidator,$fileXMLLoader,$productCreator);
//                break;
//            case 'post';
//                $postLoader = new POSTLoader();
//                $loader = new POSTProductLoader($schemeValidator,$postLoader,$productCreator);
//
//        }
//
//
//    }
//
//
//}
