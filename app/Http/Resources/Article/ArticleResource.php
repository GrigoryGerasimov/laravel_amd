<?php

namespace App\Http\Resources\Article;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'season' => trim($this->season->name),
            'buyingArticleSku' => trim($this->buying_article_sku),
            'buyingArticleConfig' => trim($this->buying_article_config),
            'brand' => trim($this->brand->name),
            'supplierArticleForm' => trim($this->supplier_article_form),
            'supplierArticleNumber' => trim($this->supplier_article_number),
            'supplierArticleName' => trim($this->supplier_article_name),
            'color' => trim($this->color->name),
            'size' => trim($this->size->code),
            'eanGtin' => trim($this->ean_gtin),
            'countryOfOrigin' => trim($this->country->name),
            'hsCode' => trim($this->hs_code),
            'lastChangeBy' => trim($this->user->name),
            'createdAt' => $this->created_at->format('Y-m-d'),
            'updatedAt' => $this->updated_at->format('Y-m-d')
        ];
    }
}
