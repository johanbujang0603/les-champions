<?php

namespace App\Transformers\V1;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources to include
     *
     * @var array
     */
    protected $availableIncludes = [
        '',
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param User $user
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
           'id' => (int) $user->id,
           'first_name' => $user->first_name,
           'last_name' => $user->last_name,
           'full_name' => $user->full_name,
           'email' => $user->email,
        ];
    }
}
