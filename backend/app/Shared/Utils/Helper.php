<?php
namespace App\Shared\Utils;

class Helper {
    private static $errors = [
        403=>'Unauthorized',
        401=>'Unauthenticated',
    ];
    public static function getErrorLable(int $statusCode){
        return self::$errors[$statusCode] ?? 'Uknowkn';
    }
}