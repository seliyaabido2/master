<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:employees,email',
            'mobile' => 'required|string|max:15',
            'country_code' => 'nullable|string|max:5',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'hobby' => 'required|array',
            'hobby.*' => 'string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ];
    }
}
