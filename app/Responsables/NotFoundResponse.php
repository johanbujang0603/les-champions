<?php

namespace App\Responsables;

class NotFoundResponse extends ErrorResponse
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
        return parent::makeResponse(404, $message);
    }
}
