<?php

namespace App\Traits;

use App\Enums\HttpStatusCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

trait RespondsWithHttpStatus
{
    /**
     * @param array<mixed> $data
     */
    protected function success(string $message, mixed $data = [], int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    protected function failure(string $message, int $status = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }
    protected function allListing(mixed $resource, string $message,
    int $status = 200): JsonResponse
    {
        // @var Collection $collect
        $collect = collect($resource)->toArray(); // @phpstan-ignore-line
        return response()->json([
            "status" => "success",
            "message" => $message,
            ...$collect
        ],$status);
    }
}