<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'numeric', 'min:0'],
            'sku' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id'=> ['required', 'numeric'],
            'image' => ['required', 'max:4096', 'image'],
            'original_price' => ['required', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
        ];
    }
}
