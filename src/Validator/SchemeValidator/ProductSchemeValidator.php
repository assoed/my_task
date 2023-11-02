<?php

namespace Validator\SchemeValidator;

use Exceptions\AppException;

class ProductSchemeValidator
{
    private array $requiredFields = ['id','name','vendorCode','price','description'];
    private array $acceptableFields = ['id','name','vendorCode','price','description'];

    public function isValid(array $data):bool
    {
        if (empty($data)){
            throw new AppException('Empty input', 400);
        }
        foreach ($this->requiredFields as $field){
          if(!array_key_exists($field,$data)||empty($data[$field])){
              throw new AppException('No required data', 400);
          }
        }

        foreach ($data as $key => $value){
            if(!in_array($key,$this->acceptableFields)){
                throw new AppException('Unnecessary data', 400);
            }
        }
        return true;
    }
}

