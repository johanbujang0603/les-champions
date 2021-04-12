<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  mixed  $user
     *
     * @return void|bool
     */
    public function before($user)
    {
        if ($user instanceof Admin) {
            return true;
        }
    }
    
    /**
     * Determine whether the admin can create the user.
     *
     *
     * @return mixed
     */
    public function create()
    {
        return false;
    }

    /**
     * Determine whether the admin can update the user.
     *
     *
     * @return mixed
     */
    public function update()
    {
        return false;
    }

    /**
     * Determine whether the admin can delete the user.
     *
     *
     * @return mixed
     */
    public function delete()
    {
        return false;
    }

    /**
     * Determine whether the admin can view the user.
     *
     *
     * @return mixed
     */
    public function view()
    {
        return false;
    }
}
