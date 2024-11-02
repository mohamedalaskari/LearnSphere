<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCourseRequest extends FormRequest
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
            //|image|mimes:png,jpg|max:1024
            'image' => 'required',
            'name' => 'required|max:30',
            'bio' => 'required|max:200',
            'price' => 'required|regex:/\d/|max:15',
            'discount' => 'required|regex:/\d/|max:15',
        ];
    }
}
