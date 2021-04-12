<?php

namespace App\Responsables;

class EmptyResponse extends HttpResponse
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
        return parent::create($message = null);
    }
}
