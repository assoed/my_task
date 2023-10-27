<?php

namespace Loaders;
use Creators\ProductCreator;
use Validator\SchemeValidator\ProductSchemeValidator;

class FileProductLoaderCSV
{

//    private $schemeValidator;
    private  $fileCSVLoader;
    private $productCreator;
    public function __construct(
        ProductSchemeValidator $schemeValidator,
        FileCSVLoader $fileCSVLoader,
        ProductCreator $productCreator
    )
    {
        $this->schemeValidator = $schemeValidator;
        $this->fileCSVLoader = $fileCSVLoader;
        $this->productCreator = $productCreator;
    }

    /**
     * @throws \Exception
     */
    public function getProductsFromCSV(string $path):array{
    $data = $this->fileCSVLoader->getDataFromFile($path);

    $productCreator = new ProductCreator($this->schemeValidator);
    return $productCreator->getProducts($data);

    }

}