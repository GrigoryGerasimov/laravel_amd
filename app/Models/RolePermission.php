<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

final class RolePermission extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'role_permissions';

    protected $guarded = false;
}
