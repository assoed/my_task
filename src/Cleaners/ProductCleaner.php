<?php

namespace Cleaners;

use Models\Product;

class ProductCleaner
{
    public function getDataCleanSecurity(Product $product): Product
    {
        foreach ($product as $key => $value) {
            $product->$key = trim(htmlspecialchars(strip_tags($value)));
        }
        return $product;
    }

}