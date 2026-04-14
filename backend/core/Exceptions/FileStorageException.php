<?php
namespace Core\Exceptions;

use Core\FailureJsonResponse;
use Exception;

class FileStorageException extends Exception{
    public function render(){
        return FailureJsonResponse::make(
            errors: $this->getMessage(),
            status:500,
            message:''
        );
    }
}