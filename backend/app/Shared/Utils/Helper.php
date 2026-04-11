<?php
namespace App\Shared\Utils;

class Helper {
    private static $errors = [
        403=>['label'=>'Unauthorized','message'=>'I cant think of it now'],
        401=>['label'=>'Unauthenticated','message'=>'I cant think of it now'],
    ];
    public static function getErrorLable(int $statusCode){
        return self::$errors[$statusCode] ?? ['label'=>'Uknowkn','message'=>'I dont know'];
    }
}