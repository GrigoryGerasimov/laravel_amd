<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

final class Season extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'seasons';

    protected $guarded = false;
}
