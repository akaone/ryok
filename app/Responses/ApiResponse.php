<?php

namespace App\Responses;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse
{
    public static function create(
        bool $success,
        string $errorCode = ApiErrorCode::NONE,
        array $data = null,
        int $statusCode = 200,
        array $headers = []
    ) {
        return response()->json([
            'success' => $success,
            'error_code' => $errorCode,
            'data' => null !== $data ? $data : new \stdClass(), // Empty data must be {} instead of []
        ], $statusCode, $headers);
    }
}
