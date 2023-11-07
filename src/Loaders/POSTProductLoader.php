<?php
namespace App\Loaders;
use Creators\ProductCreator;
use Entity\Product;
use Validator\SchemeValidator\ProductSchemeValidator;

class POSTProductLoader
{
    public function __construct(
        ProductSchemeValidator $schemeValidator
    )
    {
        $this->schemeValidator = $schemeValidator;
    }
    public function getProductFromPost():Product{

        $queryString = file_get_contents('php://input');
        parse_str($queryString,$data);
        $productCreator = new ProductCreator($this->schemeValidator);

        return $productCreator->getProduct($data);
    }
}