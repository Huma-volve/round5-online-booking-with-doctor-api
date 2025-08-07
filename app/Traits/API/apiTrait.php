<?php

namespace App\Traits\API;

trait apiTrait {
    public function successResponse($data = [], $message = 'Success', $code = 200) {
        $response = [
            'success' => true,
            'message' => $message,
        ];
        if ($data != []) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }
    public function errorResponse($errors = null, $message = 'Error', $code = 400) {
        $response = [
            'status' => 'Failed',
            'message' => $message,
        ];
        if ($errors) {
            $response['errors'] = $errors;
        }
        return response()->json($response, $code);
    }
}
