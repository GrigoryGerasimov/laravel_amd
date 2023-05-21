<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;

final class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $amdCreator = UserRole::create([
            'user_id' => 1,
            'role_id' => 1
        ]);
    }
}
