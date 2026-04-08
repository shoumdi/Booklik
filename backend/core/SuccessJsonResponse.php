<?php

namespace Core;

use Illuminate\Http\JsonResponse;

class SuccessJsonResponse
{

    public static function make(
        mixed $data, 
        int $status = 200,
        string $message = '',
        ): JsonResponse
    {
        return response()->json(
            data:[
                'status'=>'success',
                'data'=>$data,
                'message'=>$message,
                'errors'=> null
            ],
            status: $status
        );
    }
}
