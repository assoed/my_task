<?php
namespace Loaders;
use Generator;

class FileCSVLoader
{
    private $headers;


    public function getDataFromFile(string $filePath):array{
        $dataArray = [];
        $data = $this->getData($filePath);

        foreach ($data as $value){
            $dataArray[] = $value;
        }
        return $dataArray;
    }

    public function getData(string $filePath): Generator
    {
        $filePath = __DIR__ . '../../..'.$filePath;
        $fileHandle = fopen($filePath, 'r');

        if ($fileHandle === false) {
            throw new \RuntimeException('Failed to open the file.');
        }

        $this->headers = fgetcsv($fileHandle, 0, ';');

        while (($data = fgetcsv($fileHandle, 0, ';')) !== false) {
//            var_dump($data);
            // Создаем ассоциативный массив, используя заголовки как ключи
            $row = array_combine($this->headers, $data);
            yield $row;
        }

        fclose($fileHandle);
    }

    public function setDataInFile(string $filePath,array $data){
        $filePath = __DIR__ . '../../..'.$filePath;
        $fileHandle = fopen($filePath, 'w');
        fputcsv($fileHandle, $this->headers, ';');
        foreach ($data as $row){
            fputcsv($fileHandle,$row,';');
        }
        fclose($fileHandle);
    }
}