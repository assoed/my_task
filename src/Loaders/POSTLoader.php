<?php

namespace Loaders;

class POSTLoader
{
    public function load(string $array):array{
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data,true);
        return $data;
    }
}