<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatedAccountRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'is_admin' => ['nullable', 'in:0,1,2'],
            'cccd' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'max:4096', 'image'],
        ];
    }
}
