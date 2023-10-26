<?php

namespace Validator\ProductValidator;

use Models\Product;

class ProductValidator
{
    const MAX_NAME_LENGTH = 64;
    const MIN_NAME_LENGTH = 5;
    const MAX_DESCRIPTION_LENGTH = 300;
    const VENDOR_CODE_PATTERN = '/^\d{1,3}-\d{1,}$/';
    const  PRICE_PATTERN = '/^\d+,\d{2}$/';
    const MAX_VENDOR_CODE_LENGTH = 10;


    public function validate(array $productsArray): array
    {
        $validationStatuses = [];
        foreach ($productsArray as $data){
        $data = $this->convertInputDataToUTF8($data);
        $data = $this->dataSecurityCleanUp($data);
        $validationStatuses[] = $this->getInputDataValidationStatus($data);
        }
        return $validationStatuses;
    }

    private function getInputDataValidationErrors(object $product): array
    {
        $errors = array();

        if (!$this->isVendorCodeValid($product->vendorCode)) {
            $errors[] = "Vendor_code doesnt match";
        }

        if (!preg_match(ProductValidator::PRICE_PATTERN, $product->price)) {
            $errors[] = "Price doesnt match";
        }

        if (!$this->isNameValid($product->name)) {
            $errors[] = "Name doesnt match";
        }
        if (!$this->isDescriptionValid($product->description)) {
            $errors[] = "Description doesnt match";
        }

        return $errors;

    }

    private function getInputDataValidationStatus(object $product): array
    {
        $assocArrayForJson = array();
        $errors = $this->getInputDataValidationErrors($product);
        if (empty($errors)) {
            $assocArrayForJson['success'] = 'true';
        } else {
            foreach ($errors as $error) {
                $assocArrayForJson['success'] = 'false';
                $assocArrayForJson['errors'][] = $error;
            }
        }
        return $assocArrayForJson;
    }


    private function isNameValid($name): bool
    {
        return is_string($name) && strlen($name) >= ProductValidator::MIN_NAME_LENGTH && strlen($name) < ProductValidator::MAX_NAME_LENGTH;
    }

    private function isDescriptionValid(string $description): bool
    {
        return strlen($description) < ProductValidator::MAX_DESCRIPTION_LENGTH;
    }

    function isVendorCodeValid($vendorCode): bool
    {
        return preg_match(ProductValidator::VENDOR_CODE_PATTERN, $vendorCode) && strlen($vendorCode) <= ProductValidator::MAX_VENDOR_CODE_LENGTH;
    }




    private function dataSecurityCleanUp(Product $product): Product
    {

        foreach ($product as $key => $value) {
            $product->$key = trim(htmlspecialchars(strip_tags($value)));
        }
        return $product;
    }


    private function convertInputDataToUTF8(Product $product): Product
    {
        foreach ($product as $key => $value) {
            $product->$key  = mb_convert_encoding($value, 'UTF-8', 'Windows-1251');
        }
        return $product;
    }

}