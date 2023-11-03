<?php

namespace Loaders;
use Creators\ProductCreator;
use Entity\Product;
use Validator\SchemeValidator\ProductSchemeValidator;

class  FileProductLoaderXML
{
    public function __construct(
        ProductSchemeValidator $schemeValidator,
        FileXMLLoader  $fileXMLLoader,
        ProductCreator $productCreator
    )
    {
        $this->schemeValidator = $schemeValidator;
        $this->fileXMLLoader = $fileXMLLoader;
        $this->productCreator = $productCreator;
    }
    public function getProductsFromXML(string $path):Product{

            $data = $this->fileXMLLoader->getDataFromFile($path);

            $productCreator = new ProductCreator($this->schemeValidator);

            return $productCreator->getProduct($data);
    }
}