<?php

namespace App\Responsables;

class ErrorResponse extends HttpResponse
{
    /**
     * create response
     *
     * @param ?string $message
     *
     * @return mixed
     */
    public static function create(?string $message = null)
    {
        return parent::makeResponse(400, $message);
    }
}
