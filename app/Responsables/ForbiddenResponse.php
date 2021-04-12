<?php

namespace App\Responsables;

class ForbiddenResponse extends ErrorResponse
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
        return parent::makeResponse(403, $message);
    }
}
