<?php

namespace Cleaners;

use Entity\Product;

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