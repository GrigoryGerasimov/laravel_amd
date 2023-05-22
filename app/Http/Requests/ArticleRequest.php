<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'buying_article_sku' => 'required|string|min:4|max:25',
            'buying_article_config' => 'required|string|min:4|max:25',
            'brand_name' => 'required|string',
            'supplier_article_number' => 'required|integer',
            'supplier_article_name' => 'required|string',
            'supplier_color_code' => 'required|integer',
            'supplier_color_name' => 'required|string',
            'supplier_size' => 'required|string|max:5',
            'EAN/GTIN' => 'required|string|max:13',
            'country_of_origin' => 'required|string',
            'textile_outer_material' => 'required|string',
            'user_id' => 'required'
        ];
    }
}
