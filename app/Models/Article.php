<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, Relations\HasOne, SoftDeletes};

final class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'articles';

    protected $guarded = false;

    public function season(): HasOne
    {
        return $this->hasOne(Season::class);
    }

    public function brand(): HasOne
    {
        return $this->hasOne(Brand::class);
    }

    public function color(): HasOne
    {
        return $this->hasOne(Color::class);
    }

    public function size(): HasOne
    {
        return $this->hasOne(Size::class);
    }

    public function country(): HasOne
    {
        return $this->hasOne(Country::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
