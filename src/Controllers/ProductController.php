<?php
namespace Controllers;
use Creators\ProductCreator;
use Entity\Product;
use Loaders\FileCSVLoader;
use Loaders\FileXMLLoader;
use Loaders\FileProductLoaderCSV;
use Loaders\FileProductLoaderXML;
use Validator\SchemeValidator\ProductSchemeValidator;

use Exceptions\AppException;
use Validator\ProductValidator\ProductValidator;
use Models\ProductModel;
class ProductController
{

public $productValidator;
public $productModel;
public $view;
public $input;
    public function __construct(ProductValidator $productValidator,View $view,ProductModel $productModel,Product $input){
    $this->productValidator =   $productValidator ;
    $this->productModel =  $productModel;
    $this->view =  $view;
    $this->input = $input;

}
    public function addProduct():void
    {


        $this->productValidator->isProductValid($this->input);
        $response = $this->productModel->createProduct($this->input);
        $this->view->render('default',$response);
    }

    public function deleteProduct():void{
        $response = $this->productModel->deleteProduct($_GET['id']);
        $this->view->render('default',$response);
    }
    public function updateProduct():void{

        $response = $this->productModel->updateProduct($_GET['id'],$this->input);
        $this->view->render('default',$response);
    }

    public function getProductById():void
    {
        $response = $this->productModel->getProductById($_GET['id']);
        $this->view->render('default',$response);
    }
    public function getUsersProducts():void
    {
        $response = $this->productModel->getUsersProducts($_GET['user_id']);
        $this->view->render('default',$response);
    }

    public function getAllProducts():void
    {
        $response = $this->productModel->getAllProducts();
        $this->view->render('/default',$response);
    }

}
