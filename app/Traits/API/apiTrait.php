<?php

namespace App\Traits\API;

trait apiTrait {
    public function successResponse($data = [], $message = 'Success', $code = 200) {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }
    public function errorResponse($message = 'Error', $code = 400) {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }
}
