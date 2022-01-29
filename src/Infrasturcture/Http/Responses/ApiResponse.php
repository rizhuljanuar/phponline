<?php

declare(strict_types=1);

namespace Infrasturcture\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    private static array $headers = [
        'Content-Type' => 'application/vnd.api+json',
        'X-Awesome' => 'Yooo'
    ];

    public static function handle($data, null|int $status = null, array $headers = []): JsonResponse
    {
        return new JsonResponse(
            data: $data,
            status: $status,
            headers: array_merge(static::$headers, $headers),
        );
    }
}