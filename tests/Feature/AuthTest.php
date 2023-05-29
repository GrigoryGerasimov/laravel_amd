<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

final class AuthTest extends TestCase
{
    use InteractsWithExceptionHandling, WithFaker, RefreshDatabase;

    public function test_a_user_can_successfully_sign_up(): void
    {
        $testingEmail = 'test.user@testing.com';

        $user = User::create([
            'name' => $this->faker()->firstNameMale() . $this->faker()->lastName(),
            //'email' => $this->faker()->unique()->safeEmail(),
            'email' => $testingEmail,
            'password' => $this->faker()->password(8, 30)
        ]);

        $response = $this->get('/register');

        $response->assertStatus(200)->assertOk();
        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', ['email' => $testingEmail]);
    }
}
