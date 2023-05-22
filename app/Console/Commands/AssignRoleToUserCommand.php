<?php

namespace App\Console\Commands;

use App\Console\Services\UserRoleService;
use Illuminate\Console\Command;

final class AssignRoleToUserCommand extends Command
{
    protected $signature = 'user:role {role} {user_id}';

    protected $description = 'Assign role to user';

    public function handle(): void
    {
        UserRoleService::assign($this);
    }
}
