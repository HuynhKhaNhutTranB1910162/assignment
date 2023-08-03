<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'status' => ['required', 'in:0,1'],
        ];
    }
}
