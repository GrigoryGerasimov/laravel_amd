<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

final class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'countries';

    protected $guarded = false;
}
