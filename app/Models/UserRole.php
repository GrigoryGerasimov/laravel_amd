<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

final class UserRole extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_roles';

    protected $guarded = false;
}
