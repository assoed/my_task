<?php

namespace Models;

class ProductModel
{
    public string $name;
    public string $vendorCode;
    public string $price;
    public string $description;

    public function __construct($name,$vendorCode,$price,$description){
        $this->name = $name;
        $this->vendorCode = $vendorCode;
        $this->price = $price;
        $this->description = $description;
    }

    public function getProductById($productId){

    }

    getAllProducts(){

    }
    public function deleteProduct($productId){

    }

    public function createProduct($data){

    }
    public function updateProduct($productId,$data){

    }
}