<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

final class Size extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sizes';

    protected $guarded = false;
}
