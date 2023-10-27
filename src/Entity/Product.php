<?php

namespace Entity;

class Product
{
    public string $name;
    public string $vendorCode;
    public string $price;
    public string $description;

    public function __construct($name,$vendorCode,$price,$description){
        $this->name = $name;
        $this->vendorCode = $vendorCode;
        $this->price = $price;
        $this->description = $description;
    }

}