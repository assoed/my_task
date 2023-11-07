<?php
namespace Creators;
use Exception;
use Entity\Product;

use Exceptions\AppException;
use Validator\SchemeValidator\ProductSchemeValidator;

class ProductCreator
{
    private ProductSchemeValidator $schemeValidator;

    public function __construct(
        ProductSchemeValidator $schemeValidator
    ){
        $this->schemeValidator = $schemeValidator;
    }
    public  function getProduct( array $data):Product
    {

            $this->schemeValidator->isValid($data);
            return new Product($data['id'],$data['name'],$data['vendorCode'],$data['price'],$data['description']);

    }





}