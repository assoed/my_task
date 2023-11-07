<?php

namespace App\Exceptions;
use Exception;
use Throwable;
class AppException extends Exception
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }



    public function log()
    {
        $logFile = '../var/log/appError.log';
        $errorMessage = "[" . date('Y-m-d H:i:s') . "] " . $this->getMessage() . " in " . $this->getFile() . " on line " . $this->getLine() . PHP_EOL;
        file_put_contents($logFile, $errorMessage, FILE_APPEND);
    }

}