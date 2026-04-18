<?php

namespace App\Shared\Utils;

class SqlHelper
{
    static array $errors = [
        1062 => ['message'=>'Duplicate entry','status'=>422],
        1045 => ['message'=>'Duplicate entry','status'=>422],
        1146 => ['message'=>'Duplicate entry','status'=>422],
    ];

    static function response(int $code){
        return static::$errors[$code] ?? ['message'=>'Server encountred some issue','status'=>500];
    }
}
