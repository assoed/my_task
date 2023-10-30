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
use Models\ProductModel;
class ProductController
{

//    public function getRequestStatus($dataType,$filePath){
//
//        $productValidator = new ProductValidator();
//        $schemeValidator = new ProductSchemeValidator();
//        $productCreator = new ProductCreator($schemeValidator);
//
//        $products = array();
//        switch ($dataType){
//            case 'csv':
//                $fileCSVLoader = new FileCSVLoader();
//                $productLoader = new FileProductLoaderCSV($schemeValidator,$fileCSVLoader,$productCreator);
//                $products = $productLoader->getProductsFromCSV($filePath);
//                break;
//            case 'xml':
//                $fileXMLLoader = new FileXMLLoader();
//                $productLoader = new FileProductLoaderXML($schemeValidator,$fileXMLLoader,$productCreator);
//                $products = $productLoader->getProductsFromXML($filePath);
//                break;
//            case 'post';
//                $postLoader = new POSTLoader();
//                $productLoader = new POSTProductLoader($schemeValidator,$postLoader,$productCreator);
//                $products = $productLoader->getProductsFromPost();
//
//
//        }
//
//
//        return $productValidator->getValidationStatus($products);
//    }
    public function getRequestStatus($requestType):string{

        private  $productModel;
        public function __construct (ProductModel $productModel)
        {
            $this->productModel = $productModel;
        }

        switch($requestType){
            case 'POST':
                if($productId){

                   $product = $this->productModel->updateProduct($productId,$data);
                }
                else{

                    $product = $this->productModel->createProduct($data);
                }

                break;
            case 'DELETE':

                $product = $this->productModel->deleteProduct($_GET['id']);
                break;
            case 'PATCH':
            case 'PUT':

                $product = $this->productModel->updateProduct($_GET['id'],$data);
                break;

            case 'GET':
                if($productId){

                    $product = $this->productModel->getProduct($productId);

                }
                else{

                    $product = $this->productModel->getAllProducts();
                }
                break;
        }
    return $product;
    }

}
