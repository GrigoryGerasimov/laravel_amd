<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_roles';

    protected $guarded = false;
}
