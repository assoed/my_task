<?php

namespace App\Controllers;

use App\Creators\ProductCreator;
use App\Validator\SchemeValidator\ProductSchemeValidator;

use App\Exceptions\AppException;
use App\Validator\ProductValidator\ProductValidator;
use App\Models\ProductModel;


class ProductController
{

public $productValidator;
public $productModel;
public $view;

public $data;
    public function __construct(ProductValidator $productValidator,View $view,ProductModel $productModel,array $data){
    $this->productValidator =   $productValidator ;
    $this->productModel =  $productModel;
    $this->view =  $view;
    $this->data = $data;

}
    public function addProduct():void
    {

            $schemeValidator = new ProductSchemeValidator();

            $productCreator = new ProductCreator($schemeValidator);
            $product = $productCreator->getProduct($this->data);
            $this->productValidator->isProductValid($product);
            $response = $this->productModel->createProduct($product);
            $this->view->render('default',$response);

//        catch (AppException $e){
//            $e->log();
//        }


    }

    public function deleteProduct():void{

        $response = $this->productModel->deleteProduct($this->data['id']);
        $this->view->render('default',$response);

    }
    public function updateProduct():void{

        $response = $this->productModel->updateProduct($this->data['id'],$this->data);
        $this->view->render('default',$response);
    }

    public function getProductById():void
    {
        $response = $this->productModel->getProductById($this->data['id']);
        $this->view->render('default',$response);
    }
    public function getUsersProducts():void
    {
        $response = $this->productModel->getUsersProducts($this->data['user_id']);
        $this->view->render('default',$response);
    }

    public function getAllProducts():void
    {
        $response = $this->productModel->getAllProducts();
        $this->view->render('default',$response);
    }

}
