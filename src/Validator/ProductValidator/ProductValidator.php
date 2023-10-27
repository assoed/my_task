<?php

namespace Validator\ProductValidator;

use Models\Product;
use Cleaners\ProductCleaner;
use Converters\ProductUTF8Converter;
class ProductValidator
{
    const MAX_NAME_LENGTH = 64;
    const MIN_NAME_LENGTH = 5;
    const MAX_DESCRIPTION_LENGTH = 300;
    const VENDOR_CODE_PATTERN = '/^\d{1,3}-\d{1,}$/';
    const  PRICE_PATTERN = '/^\d+,\d{2}$/';
    const MAX_VENDOR_CODE_LENGTH = 10;


    public function getValidationStatus(array $productsArray): array
    {
        $cleaner = new ProductCleaner();
        $converter = new ProductUTF8Converter();
        $validationStatus = [];
        foreach ($productsArray as $data){
        $data = $converter->getconvertedDataToUTF8($data);
        $data = $cleaner->getDataCleanSecurity($data);
        $validationStatus[] = $this->getInputDataValidationStatus($data);
        }
        return $validationStatus;
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




}