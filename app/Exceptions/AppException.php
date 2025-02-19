<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class AppException extends Exception
{
    public function render()
    {
        return response()->json([
            'code' => $this->getCode() ?: 500,
            'message' => $this->getMessage(),
            'data' => null
        ], $this->getCode() ?: 500);
    }
}
