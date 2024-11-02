<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'image' => 'required|image|mimes:png,jpg|max:1024',
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'phone' => 'required|regex:/\d/|max:13|unique:users,phone',
            'email' => 'required|email|unique:users,email|max:40',
            'password' => 'required|confirmed|min:6|max:12',

        ];
    }
}
