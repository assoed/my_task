<?php

namespace Converters;
use Models\Product;

class ProductUTF8Converter
{
    public function getconvertedDataToUTF8(Product $product): Product
    {
        foreach ($product as $key => $value) {
            $product->$key  = mb_convert_encoding($value, 'UTF-8', 'Windows-1251');
        }
        return $product;
    }
}