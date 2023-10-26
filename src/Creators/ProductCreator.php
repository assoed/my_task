<?php
namespace Creators;
use Exception;
use Models\Product;
use Validator\SchemeValidator\ProductSchemeValidator;

class ProductCreator
{
    private $schemeValidator;

    public function __construct(
        ProductSchemeValidator $schemeValidator
    ){
        $this->schemeValidator = $schemeValidator;
    }
    public  function createProducts($data)
    {
        $products = [];
        foreach ($data as $value){
            if(!$this->schemeValidator->validate($value)){
                throw new Exception("Invalid");
            }
            $products[] = new Product($value['name'],$value['vendorCode'],$value['price'],$value['description']);
        }
        return $products;
    }
}