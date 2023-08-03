<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;

class CreateBannerRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'image' => ['required', 'max:4096', 'image'],
            'status' => ['required', 'in:0,1'],
        ];
    }
}
