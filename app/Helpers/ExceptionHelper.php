<?php

namespace App\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;

trait ExceptionHelper
{
    public static function throwException($status, $message)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => $status,
                'message' => $message,
            ], $status)
        );
    }
}
