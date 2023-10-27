<?php

namespace Validator\SchemeValidator;

class ProductSchemeValidator
{
    private array $requiredFields = ['name','vendorCode','price','description'];

    public function isValid(array $data):bool
    {
        if (empty($data)){
            return false;
        }
        foreach ($this->requiredFields as $field){
          if(!array_key_exists($field,$data)||empty($data[$field])){
              return false;
          }
        }

        foreach ($data as $key => $value){
            if(!in_array($key,$this->requiredFields)){
                return false;
            }
        }
        return true;
    }
}