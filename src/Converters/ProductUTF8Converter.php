<?php

namespace Converters;
use Models\ProductModel;

class ProductUTF8Converter
{
    public function getconvertedDataToUTF8(ProductModel $product): ProductModel
    {
        foreach ($product as $key => $value) {
            $product->$key  = mb_convert_encoding($value, 'UTF-8', 'Windows-1251');
        }
        return $product;
    }
}