<?php

namespace Tests\Feature\Console;

use App\Console\Commands\{AssignRoleToUserCommand, RevokeRoleFromUserCommand};
use App\Models\{User, Role};
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\{WithFaker, RefreshDatabase};
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Tests\TestCase;

final class UserRoleCommandTest extends TestCase
{
    use InteractsWithExceptionHandling, WithFaker, RefreshDatabase;

    /** @test */
    public function test_assigning_role_to_user_command(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $user = User::factory()->create();
        $this->seed(DatabaseSeeder::class);
        $roleSlug = Role::first()->slug;

        $this
            ->artisan(AssignRoleToUserCommand::class, [
                'user_id' => $user->id,
                'role' => $roleSlug
            ])
            ->assertSuccessful()
            ->assertExitCode(0)
            ->expectsOutput("Role $roleSlug successfully assigned to user ID $user->id");

        $this->assertTrue($user->hasRole($roleSlug));
    }

    /** @test */
    public function test_revoking_role_from_user_command(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $user = User::factory()->create();
        $this->seed(DatabaseSeeder::class);
        $roleSlug = Role::first()->slug;

        $this->artisan(AssignRoleToUserCommand::class, [
            'user_id' => $user->id,
            'role' => $roleSlug
        ]);

        $this
            ->artisan(RevokeRoleFromUserCommand::class, [
                'user_id' => $user->id,
                'role' => $roleSlug
            ])
            ->assertSuccessful()
            ->assertExitCode(0)
            ->expectsOutput("Role $roleSlug has been successfully removed from user ID $user->id");

        $this->assertFalse($user->hasRole($roleSlug));
    }

    /** @test */
    public function test_not_assigning_role_to_user_while_user_already_has_role_command(): void
    {
        $user = User::factory()->create();
        $this->seed(DatabaseSeeder::class);
        $role = Role::first();

        $user->roles()->attach($role);

        $this
            ->artisan(AssignRoleToUserCommand::class, [
                'user_id' => $user->id,
                'role' => $role->slug
            ])
            ->assertExitCode(0)
            ->expectsOutput("User ID $user->id already has role $role->slug assigned");
    }

    /** @test */
    public function test_not_revoking_role_from_user_while_user_does_not_have_role_command(): void
    {
        $user = User::factory()->create();
        $this->seed(DatabaseSeeder::class);
        $role = Role::first();

        $this
            ->artisan(RevokeRoleFromUserCommand::class, [
                'user_id' => $user->id,
                'role' => $role->slug
            ])
            ->assertExitCode(0)
            ->expectsOutput("User ID $user->id does not have role $role->slug assigned");
    }

    /** @test */
    public function test_not_assigning_role_to_user_due_to_invalid_data_command(): void
    {
        $user = User::factory()->create();
        $this->seed(DatabaseSeeder::class);
        $role = Role::first();

        $fakeId = 134;

        $this
            ->artisan(AssignRoleToUserCommand::class, [
                'user_id' => $fakeId,
                'role' => $role->slug
            ])
            ->expectsOutputToContain("No user with ID $fakeId identified");

        $this->assertFalse($user->hasRole($role->slug));
    }

    /** @test */
    public function test_not_revoking_role_from_user_due_to_invalid_data_command(): void
    {
        $user = User::factory()->create();
        $this->seed(DatabaseSeeder::class);
        $role = Role::first();

        $this->artisan(AssignRoleToUserCommand::class, [
            'user_id' => $user->id,
            'role' => $role->slug
        ]);

        $fakeSlug = 'some_non_existing_slug';

        $this
            ->artisan(RevokeRoleFromUserCommand::class, [
                'user_id' => $user->id,
                'role' => $fakeSlug
            ])
            ->expectsOutput("No role $fakeSlug identified");

        $this->assertTrue($user->hasRole($role->slug));
    }
}
