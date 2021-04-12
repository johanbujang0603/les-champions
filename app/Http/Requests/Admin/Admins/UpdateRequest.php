<?php

namespace App\Http\Requests\Admin\Admins;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'password' => 'nullable|string|min:6|confirmed',
            'email' => 'required|email|unique:admins,email,'.Auth::guard('admin')->id(),
        ];
    }
}
