<?php
namespace Creators;
use Exception;
use Models\ProductModel;
use Validator\SchemeValidator\ProductSchemeValidator;

class ProductCreator
{
    private object $schemeValidator;

    public function __construct(
        ProductSchemeValidator $schemeValidator
    ){
        $this->schemeValidator = $schemeValidator;
    }
    public  function getProducts($data)
    {
        $products = [];
        foreach ($data as $value){
            if(!$this->schemeValidator->isValid($value)){
                throw new Exception("Invalid");
            }
            $products[] = new ProductModel($value['name'],$value['vendorCode'],$value['price'],$value['description']);
        }
        return $products;
    }
}