<?php

namespace Cleaners;

use Models\ProductModel;

class ProductCleaner
{
    public function getDataCleanSecurity(ProductModel $product): ProductModel
    {
        foreach ($product as $key => $value) {
            $product->$key = trim(htmlspecialchars(strip_tags($value)));
        }
        return $product;
    }

}