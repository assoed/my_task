<?php

namespace Models;

use Creators\ProductCreator;
use Entity\Product;
use Loaders\FileCSVLoader;
use Loaders\POSTLoader;
use Loaders\POSTProductLoader;
use Validator\SchemeValidator\ProductSchemeValidator;
use Exceptions\AppException;
class ProductModel
{

    public function getProductById($productId){
        $productFound = false;
        $productData = array();
        $fileCSVLoader = new FileCSVLoader();
        $products = $fileCSVLoader->getDataFromFile('/dataCSV.csv');
        foreach ($products as $item){
            if($item['id']==$productId){
                $productFound = true;
                $productData[] = $item;

            }

        }

        if (!$productFound) {
            return ['status' => 404, 'message' => ['error' => 'The specified resource was not found']];
        } else {
            return ['status' => 204, 'message' => ['success' => 'Product found'],'products'=>$productData];
        }
    }

    public function getUsersProducts($userId){
        $productFound = false;
        $productData = array();
        $fileCSVLoader = new FileCSVLoader();
        $products = $fileCSVLoader->getDataFromFile('/dataCSV.csv');
        foreach ($products as $item){
            if($item['user_id']==$userId){
                $productFound = true;


            }

        }
        if (!$productFound) {
            return ['status' => 404, 'message' => ['error' => 'The specified resource was not found']];
        } else {
            return ['status' => 204, 'message' => ['success' => 'Product successfully updated']];
        }
    }
    public function getAllProducts(){

    $fileCSVLoader = new FileCSVLoader();
    $products = $fileCSVLoader->getDataFromFile('/dataCSV.csv');

    return ['status' => 200, 'products'=>$products];
    }
    public function deleteProduct($productId): array
    {
        $productFound = false;
        $fileCSVLoader = new FileCSVLoader();
        $products = $fileCSVLoader->getDataFromFile('/dataCSV.csv');
        foreach ($products as $key => $item) {
            if ($item['id'] == $productId) {
                unset($products[$key]);
                $productFound = true;
            }
        }

        $fileCSVLoader->setDataInFile('/dataCSV.csv', $products);
        if (!$productFound) {
            return ['status' => 404, 'message' => ['error' => 'The specified resource was not found']];
        } else {
            return ['status' => 204, 'message' => ['success' => 'Product successfully deleted']];
        }
    }



        public function createProduct(Product $product): array {
        $data = array(
            'id'            =>  $product->id,
            'name'          =>  $product->name,
            'vendorCode'    =>  $product->vendorCode,
            'price'         =>  $product->price,
            'description'   =>  $product->description

        );
            $filePath = '/dataCSV.csv';
            $fileCSVLoader = new FileCSVLoader();
            $existingData = $fileCSVLoader->getDataFromFile('/dataCSV.csv');

            $existingData[] = $data;

            $fileCSVLoader->setDataInFile('/dataCSV.csv', $existingData);


            return ['status' => 201, 'message' => ['success' => 'Successfully  product created']];
        }


    public function updateProduct($productId,$data):array{
        $productFound = false;
        $fileCSVLoader = new FileCSVLoader();
        $products = $fileCSVLoader->getDataFromFile('/dataCSV.csv');
        foreach ($products as $key => $item){
            if($item['id'] == $productId){

                $productFound = true;
            }
        }
        if (!$productFound) {
            return ['status' => 404, 'message' => ['error' => 'The specified resource was not found']];
        } else {
            return ['status' => 204, 'message' => ['success' => 'Product successfully updated']];
        }
    }
}