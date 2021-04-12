<?php

namespace App\Responsables;

use Illuminate\Http\JsonResponse;

class HttpResponse
{
    /**
     * create response
     *
     * @param int $code
     * @param ?string $message
     *
     * @return mixed
     */
    public static function makeResponse(int $code = 200, ?string $message = null)
    {
        return $message === null ? response(null, $code) : response()->json([
            'message' => $message,
        ], $code);
    }

    public static function json(array $data, int $code = 200) : JsonResponse
    {
        return response()->json($data, $code);
    }

    /**
     * create response
     *
     * @param ?string $message
     *
     * @return mixed
     */
    public static function create(?string $message = null)
    {
        return self::makeResponse(200, $message);
    }
}
