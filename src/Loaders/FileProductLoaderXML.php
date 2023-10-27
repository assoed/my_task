<?php

namespace Loaders;
use Creators\ProductCreator;
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
    public function getProductsFromXML(string $path):array{

            $data = $this->fileXMLLoader->getDataFromFile($path);

            $productCreator = new ProductCreator($this->schemeValidator);

            return $productCreator->getProducts($data);
    }
}