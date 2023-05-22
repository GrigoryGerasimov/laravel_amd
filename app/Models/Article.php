<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, SoftDeletes};

final class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'articles';

    protected $fillable = [
        'buying_article_sku',
        'buying_article_config',
        'brand_name',
        'supplier_article_number',
        'supplier_article_name',
        'supplier_color_code',
        'supplier_color_name',
        'supplier_size',
        'EAN/GTIN',
        'country_of_origin',
        'textile_outer_material',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
