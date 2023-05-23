<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

final class Color extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'colors';

    protected $guarded = false;
}
