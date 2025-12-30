<?php

namespace App\Traits\ApiResponse;

use Illuminate\Http\JsonResponse;

trait JsonResponseTrait
{
    protected function successResponse(mixed $data, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'code' => $code
        ], $code);
    }

    protected function successMessage(string $message, mixed $data = [], int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'code' => $code
        ], $code);
    }

    protected function errorResponse(mixed $message, int $code = 404): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => [],
            'code' => $code
        ], $code);
    }

}
