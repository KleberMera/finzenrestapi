<?php

namespace App\Classes;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiResponseClass
{
    public static function rollback($e, $message = '¡Algo salió mal! Proceso no completado.')
    {
        DB::rollBack();
        self::throw($e, $message);
    }

    public static function throw($e, $message = '¡Algo salió mal! Proceso no completado.')
    {
        Log::info($e);
        throw new HttpResponseException(response()->json([
            'message'=>$message
        ], 500));
    }

    public static function sendResponse($result, $message, $code = 200)
    {
        if($code === 204) {
            return response()->noContent();
        }

        $response = [
            'success' => true,
            'data' => $result
        ];

        if(!empty($message)) {
            $response['message'] = $message;
        }

        return response()->json($response, $code);
    }
}