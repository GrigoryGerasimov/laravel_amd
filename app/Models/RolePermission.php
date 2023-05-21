<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class RolePermission extends Model
{
    use HasFactory;

    protected $table = 'role_permissions';

    protected $guarded = false;
}
