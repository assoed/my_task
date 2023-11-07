<?php

namespace App\Loaders;
use Creators\ProductCreator;
use Entity\Product;
use Validator\SchemeValidator\ProductSchemeValidator;

class FileProductLoaderCSV
{

//    private $schemeValidator;
    private FileCSVLoader $fileCSVLoader;
    private ProductCreator $productCreator;
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
    public function getProductsFromCSV(string $path):Product{
    $data = $this->fileCSVLoader->getDataFromFile($path);

    $productCreator = new ProductCreator($this->schemeValidator);
    return $productCreator->getProduct($data);

    }

}