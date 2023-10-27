<?php
namespace Loaders;
use Creators\ProductCreator;
use Validator\SchemeValidator\ProductSchemeValidator;

class POSTProductLoader
{
    public function __construct(
        ProductSchemeValidator $schemeValidator,
        POSTLoader $postLoader,
        ProductCreator $productCreator

    )
    {
        $this->schemeValidator = $schemeValidator;
        $this->POSTLoader = $postLoader;
        $this->productCreator = $productCreator;

    }
    public function getProductsFromPost(string $array):array{

        $data = $this->POSTLoader->getDataFromPost($array) ;
        $productCreator = new ProductCreator($this->schemeValidator);

        return $productCreator->getProducts($data);
    }
}