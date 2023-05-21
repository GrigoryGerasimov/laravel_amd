<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

final class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $create = Permission::create([
            'name' => 'create'
        ]);
        $edit = Permission::create([
            'name' => 'edit'
        ]);
        $review = Permission::create([
            'name' => 'review'
        ]);
        $approve = Permission::create([
            'name' => 'approve'
        ]);
    }
}
