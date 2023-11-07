<?php

namespace App\Loggers;


=======
use Exceptions\AppException;


class ProductLogger
{


    function logProductErrors($appException){
        $logFile = '../var/log/appError.log';

        $errorMessage = "[" . date('Y-m-d H:i:s') . "] " . $appException->getMessage() . " in " . $appException->getFile() . " on line " . $appException->getLine() . PHP_EOL;

        file_put_contents($logFile, $errorMessage, FILE_APPEND);
    }

