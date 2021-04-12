<?php

namespace App\Responsables;

use League\Fractal\Scope;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use App\Serializers\CustomArraySerializer;
use League\Fractal\Resource\ResourceInterface;

class ResponseWithManager extends Response
{
    /**
     * Fractal resource manager
     */
    protected ?\League\Fractal\Manager $manager = null;

    /**
     * @param mixed  $data
     * @param bool $as_collection
     */
    public function __construct($data, bool $as_collection = false)
    {
        parent::__construct($data, $as_collection);
        $this->createManager();
    }

    /**
     * Create a new manager and update it
     *
     * @return void
     */
    private function createManager()
    {
        $this->manager = new Manager();
        if (request()->input('include')) {
            $this->manager->parseIncludes(request()->input('include'));
        }
        $this->manager->setSerializer(new CustomArraySerializer());
    }

    /**
     * Call createData method of the manager
     *
     * @param ResourceInterface $resource
     * @param ?string $scopeIdentifier
     * @param ?Scope $parentScopeInstance
     *
     * @return mixed
     */
    protected function createData(ResourceInterface $resource, string $scopeIdentifier = null, Scope $parentScopeInstance = null)
    {
        return is_null($this->manager) ? false : $this->manager->createData($resource, $scopeIdentifier, $parentScopeInstance);
    }
}
