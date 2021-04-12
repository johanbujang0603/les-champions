<?php

namespace App\Responsables;

class UnauthorizedResponse extends ErrorResponse
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
        return parent::makeResponse(401, $message);
    }
}
