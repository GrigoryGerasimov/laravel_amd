<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

final class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'brands';

    protected $guarded = false;
}
