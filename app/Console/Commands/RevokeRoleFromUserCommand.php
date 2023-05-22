<?php

namespace App\Console\Commands;

use App\Console\Services\UserRoleService;
use Illuminate\Console\Command;

final class RevokeRoleFromUserCommand extends Command
{
    protected $signature = 'user:revoke {role} {user_id}';

    protected $description = 'Revoke role from user';

    public function handle(): void
    {
        UserRoleService::revoke($this);
    }
}
