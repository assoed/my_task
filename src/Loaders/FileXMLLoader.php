<?php

namespace App\Loaders;
class FileXMLLoader
{
    public function getDataFromFile($filePath):array{
        $filePath = __DIR__ . '/../../'.$filePath;
        $xmlStr = file_get_contents($filePath);
        $xmlFile = simplexml_load_string( $xmlStr);
        $products = array();

          foreach ($xmlFile->product as $productNode){
            $productXML = array();
            $productXML['vendorCode']  = (string)$productNode->vendorCode;
            $productXML ['price']       = (string)$productNode->price;
            $productXML ['name']        = (string)$productNode->name;
            $productXML ['description'] = (string)$productNode->description;
          $products[] = $productXML;
          }
        return $products;
    }



}