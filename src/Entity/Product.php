<?php

namespace Entity;

class Product
{
    public string $name;
    public string $vendorCode;
    public string $price;
    public string $description;
    public int $id;
    public function __construct($id,$name,$vendorCode,$price,$description){
        $this->id = $id;
        $this->name = $name;
        $this->vendorCode = $vendorCode;
        $this->price = $price;
        $this->description = $description;
    }
}