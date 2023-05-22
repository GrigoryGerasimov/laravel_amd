<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Log;
use App\Models\{Role, User};
use Illuminate\Console\Command;

final class AssignRoleToUserCommand extends Command
{
    protected $signature = 'user:role {role} {user_id}';

    protected $description = 'Assign role to user';

    public function handle(): void
    {
        try {
            $slug = $this->argument('role');
            $userId = $this->argument('user_id');

            $role = Role::where('slug', $slug)->first();
            $user = User::findOrFail($userId);

            $user->roles()->attach($role);

            $this->info("Role $slug successfully assigned to user $userId");
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
