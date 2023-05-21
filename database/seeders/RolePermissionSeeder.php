<?php

namespace Database\Seeders;

use App\Models\RolePermission;
use Illuminate\Database\Seeder;

final class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $amdCreatorCreate = RolePermission::create([
            'role_id' => 1,
            'permission_id' => 1
        ]);
        $amdCreatorEdit = RolePermission::create([
            'role_id' => 1,
            'permission_id' => 2
        ]);

        $amdManagerEdit = RolePermission::create([
            'role_id' => 2,
            'permission_id' => 2
        ]);
        $amdManagerReview = RolePermission::create([
            'role_id' => 2,
            'permission_id' => 3
        ]);
        $amdManagerApprove = RolePermission::create([
            'role_id' => 2,
            'permission_id' => 4
        ]);
    }
}
