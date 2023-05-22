<?php

namespace App\Console\Commands;

use App\Models\{Role, User};
use Illuminate\Console\Command;
use Illuminate\Support\Facades\{Log, DB};

final class AssignRoleToUserCommand extends Command
{
    protected $signature = 'user:role {role} {user_id}';

    protected $description = 'Assign role to user';

    public function handle(): void
    {
        try {
            DB::beginTransaction();

            $slug = $this->argument('role');
            $userId = $this->argument('user_id');

            $role = Role::where('slug', $slug)->first();
            $user = User::findOrFail($userId);

            $user->roles()->attach($role);

            $this->info("Role $slug successfully assigned to user $userId");

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            Log::error($e->getMessage());
        }
    }
}
