<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                'max:100'
            ],
            'mobile' => 'required|numeric|digits:10',
            'country_code' => 'required|nullable|string|max:5',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'hobby' => 'required|array',
            'hobby.*' => 'string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ];
    }

}
