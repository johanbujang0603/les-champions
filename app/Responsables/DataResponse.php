<?php

namespace App\Responsables;

use Illuminate\Http\JsonResponse;

final class DataResponse
{
    public static function create(array $data, int $code = 200) : JsonResponse
    {
        return response()->json([
            'data' => $data,
        ], $code);
    }
}
