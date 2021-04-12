<?php

namespace App\Responsables;

use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Responsable;

abstract class Response implements Responsable
{
    /**
     * @var mixed
     */
    protected $data;

    protected bool $as_collection = false;

    protected ?\Illuminate\Http\Request $request = null;

    /**
     * @param mixed  $data
     * @param bool $as_collection
     */
    public function __construct($data, bool $as_collection = false)
    {
        $this->data = $data;
        $this->as_collection = $as_collection;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     */
    public function toResponse($request)
    {
        $this->request = $request;
        
        if ($this->isCollection()) {
            return $this->toJsonCollectionResponse($this->data);
        }

        return $this->toJsonResponse($this->data);
    }

    /**
     * Determine if response should return a collection.
     *
     * @return boolean
     */
    public function isCollection() : bool
    {
        return $this->as_collection;
    }
}
