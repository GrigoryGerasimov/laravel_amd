<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'slug',
        'permissions'
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id');
    }

    public function hasPermission(string $permission): bool
    {
        return $this->permissions[$permission] ?? false;
    }
}
