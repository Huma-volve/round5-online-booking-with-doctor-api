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
    public function errorResponse($errors = null, $message = 'Error', $code = 400) {
        $response = [
            'status' => 'Error occurred',
            'message' => $message,
        ];
        if ($errors) {
            $response['errors'] = $errors;
        }
        return response()->json($response, $code);
    }
}
