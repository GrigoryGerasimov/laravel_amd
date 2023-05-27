<?php

namespace App\Http\Resources\Article;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'season' => $this->season->name,
            'buyingArticleSku' => $this->buying_article_sku,
            'buyingArticleConfig' => $this->buying_article_config,
            'brand' => $this->brand->name,
            'supplierArticleForm' => $this->supplier_article_form,
            'supplierArticleNumber' => $this->supplier_article_number,
            'supplierArticleName' => $this->supplier_article_name,
            'color' => $this->color->name,
            'size' => $this->size->code,
            'eanGtin' => $this->ean_gtin,
            'countryOfOrigin' => $this->country->name,
            'hsCode' => $this->hs_code,
            'lastChangeBy' => $this->user->name,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
