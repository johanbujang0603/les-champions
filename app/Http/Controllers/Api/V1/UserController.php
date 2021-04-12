<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Responsables\V1\UserResponse;

class UserController extends Controller
{
    public function index() : UserResponse
    {
        return new UserResponse(User::query(), true);
    }
}
