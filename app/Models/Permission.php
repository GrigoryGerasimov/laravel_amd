<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $guarded = false;

    public function roles(): BelongsToMany
    {
        $this->belongsToMany(Role::class, 'role_permissions', 'role_id', 'permission_id');
    }
}
