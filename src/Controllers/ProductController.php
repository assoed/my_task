<?php
namespace Controllers;
use Creators\ProductCreator;
use Loaders\FileCSVLoader;
use Loaders\FileXMLLoader;
use Loaders\FileProductLoaderCSV;
use Loaders\FileProductLoaderXML;
use Validator\SchemeValidator\ProductSchemeValidator;
use Loaders\POSTProductLoader;
use Loaders\POSTLoader;
use Validator\ProductValidator\ProductValidator;

class ProductController
{

    public function getRequestStatus($dataType,$filePath){
        $productLoader = null;
        $productValidator = new ProductValidator();
        $schemeValidator = new ProductSchemeValidator();
        $productCreator = new ProductCreator($schemeValidator);

        $products = array();
        switch ($dataType){
            case 'csv':
                $fileCSVLoader = new FileCSVLoader();
                $productLoader = new FileProductLoaderCSV($schemeValidator,$fileCSVLoader,$productCreator);
                $products = $productLoader->getProductsFromCSV($filePath);
                break;
            case 'xml':
                $fileXMLLoader = new FileXMLLoader();
                $productLoader = new FileProductLoaderXML($schemeValidator,$fileXMLLoader,$productCreator);
                $products = $productLoader->getProductsFromXML($filePath);
                break;
            case 'post';
                $postLoader = new POSTLoader();
                $productLoader = new POSTProductLoader($schemeValidator,$postLoader,$productCreator);
                $products = $productLoader->getProductsFromPost();

        }



        return $productValidator->getValidationStatus($products);
    }


}
