<?php

namespace Core;

use Illuminate\Http\JsonResponse;

class FailureJsonResponse
{

    public static function make(
        mixed $errors, 
        int $status = 200,
        string $message = '',
        ): JsonResponse
    {
        return response()->json(
            data:[
                'status'=>'failure',
                'data'=>null,
                'message'=>$message,
                'errors'=> $errors
            ],
            status: $status
        );
    }
}
