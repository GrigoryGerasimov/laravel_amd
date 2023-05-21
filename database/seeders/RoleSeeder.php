<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

final class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $amdCategoryCreator = Role::create([
            'name' => 'AMD Category Creator',
            'slug' => 'amd-creator'
        ]);

        $amdCategoryManager = Role::create([
            'name' => 'AMD Category Manager',
            'slug' => 'amd-manager'
        ]);
    }
}
