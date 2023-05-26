<?php

namespace App\Http\Requests;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

final class ArticleUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'season_id' => 'required|integer',
            'buying_article_sku' => [
                'required', 'string', 'min:4', 'max:13',
                Rule::unique('articles')->ignore($this->request->get('id'), 'id')
            ],
            'buying_article_config' => 'required|string|min:4|max:13',
            'brand_id' => 'required|integer',
            'supplier_article_form' => 'required|string',
            'supplier_article_number' => 'required|string',
            'supplier_article_name' => 'required|string',
            'color_id' => 'required|integer',
            'size_id' => 'required|integer',
            'ean_gtin' => [
                'required', 'string', 'max:13',
                Rule::unique('articles')->ignore($this->request->get('id'), 'id')
            ],
            'country_id' => 'required|integer',
            'hs_code' => 'required|string|min:4|max:13',
            'user_id' => 'required|integer'
        ];
    }
}
