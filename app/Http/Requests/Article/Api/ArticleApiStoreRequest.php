<?php

namespace App\Http\Requests\Article\Api;

use Illuminate\Foundation\Http\FormRequest;

final class ArticleApiStoreRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'season_id' => 'required|integer',
            'buying_article_sku' => 'required|string|min:4|max:13|unique:articles',
            'buying_article_config' => 'required|string|min:4|max:13',
            'brand_id' => 'required|integer',
            'supplier_article_form' => 'required|string',
            'supplier_article_number' => 'required|string',
            'supplier_article_name' => 'required|string',
            'color_id' => 'required|integer',
            'size_id' => 'required|integer',
            'ean_gtin' => 'required|string|max:13|unique:articles',
            'country_id' => 'required|integer',
            'hs_code' => 'required|string|min:4|max:13',
            'user_id' => 'required|integer'
        ];
    }
}
