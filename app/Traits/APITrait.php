<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait APITrait
{
    public function apiResponse($data = [], $status = Response::HTTP_OK, $message = 'Success!') : JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message'=> $message
        ], $status);
    }

    public function apiBadRequest($error) {
        return response()->json([
            'message' => 'Bad Request',
            'error' => $error
        ], 400);
    }

    public function apiNotFound($error) {
        return response()->json([
            'message' => 'Not Found',
            'error' => $error
        ], 404);
    }
}
