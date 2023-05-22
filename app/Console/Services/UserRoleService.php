<?php

declare(strict_types=1);

namespace App\Console\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;

final class UserRoleService
{
    private static function retrieveUser(Command $cmd): User
    {
        try {
            $userId = $cmd->argument('user_id');

            $user = User::find($userId);

            if (!isset($user)) {
                throw new \Exception("No user with ID $userId identified");
            }

            return $user;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private static function retrieveRole(Command $cmd): Role
    {
        try {
            $slug = $cmd->argument('role');

            $role = Role::where('slug', $slug)->first();

            if (!isset($role)) {
                throw new \Exception("No role $slug identified");
            }

            return $role;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public static function assign(Command $cmd): void
    {
        try {
            DB::beginTransaction();

            $user = self::retrieveUser($cmd);
            $role = self::retrieveRole($cmd);

            if (!$user->hasRole($role->slug)) {
                $user->roles()->attach($role);
                $cmd->info("Role $role->slug successfully assigned to user ID $user->id");
            } else {
                $cmd->info("User ID $user->id already has role $role->slug assigned");
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            Log::error($e->getMessage());
            $cmd->error($e->getMessage());
        }
    }

    public static function revoke(Command $cmd): void
    {
        try {
            DB::beginTransaction();

            $user = self::retrieveUser($cmd);
            $role = self::retrieveRole($cmd);

            if ($user->hasRole($role->slug)) {
                $user->roles()->detach($role);
                $cmd->info("Role $role->slug has been successfully removed from user ID $user->id");
            } else {
                $cmd->info("User ID $user->id does not have role $role->slug assigned");
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            Log::error($e->getMessage());
            $cmd->error($e->getMessage());
        }
    }
}
