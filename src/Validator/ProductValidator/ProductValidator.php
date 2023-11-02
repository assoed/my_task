<?php

namespace Validator\ProductValidator;

use Cleaners\ProductCleaner;
use Converters\ProductUTF8Converter;
use Entity\Product;
use Exceptions\AppException;

class ProductValidator
{
    const MAX_NAME_LENGTH = 64;
    const MIN_NAME_LENGTH = 5;
    const MAX_DESCRIPTION_LENGTH = 300;
    const VENDOR_CODE_PATTERN = '/^\d{1,3}-\d{1,}$/';
    const  PRICE_PATTERN = '/^\d+,\d{2}$/';
    const MAX_VENDOR_CODE_LENGTH = 10;


    public function isProductValid(Product $product):bool{
   
            $this->isVendorCodeValid($product->vendorCode);
            $this->isPriceValid($product->price);
            $this->isNameValid($product->name);
            $this->isDescriptionValid($product->description);
            return true;   
        

    }



    private function isNameValid($name): bool
    {
        if (!(is_string($name) && mb_strlen($name) >= self::MIN_NAME_LENGTH && mb_strlen($name) <= self::MAX_NAME_LENGTH)) {

                throw new AppException('Name is not correct', 400);

            }



        return true;
    }

    private function isDescriptionValid(string $description): bool
    {

            if (!(strlen($description) <= self::MAX_DESCRIPTION_LENGTH)) {

                throw new AppException('Description is not correct', 400);
            }


        return true;
    }

    private function isVendorCodeValid($vendorCode): bool
    {

            if (!preg_match(self::VENDOR_CODE_PATTERN, $vendorCode) && mb_strlen($vendorCode) <= self::MAX_VENDOR_CODE_LENGTH) {

                throw new AppException('Vendor code is not correct', 400);
            }



        return true;
    }

    private function isPriceValid(string $price): bool
    {

            if (!preg_match(self::PRICE_PATTERN, $price)) {

                throw new AppException('Price is not correct', 400);
            }



        return true;
    }



}

