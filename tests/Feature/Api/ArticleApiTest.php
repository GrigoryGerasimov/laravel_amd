<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\{WithFaker, RefreshDatabase};
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Tests\TestCase;

final class ArticleApiTest extends TestCase
{
    use InteractsWithExceptionHandling, WithFaker, RefreshDatabase;

    /** @test */
    public function test_a_registered_user_can_pass_jwt_auth(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $credentials = [
            'email' => 'james.su.test@test.com',
            'password' => 'Password@12345'
        ];

        $user = User::create(['name' => 'James Sutherland', ...$credentials]);

        $response = $this->post('/api/auth/login', $credentials);
        $response
            ->assertJson([
                'token_type' => 'bearer',
                'expires_in' => 3600
            ])
            ->assertSuccessful()
            ->assertStatus(200);
    }

    /** @test */
    public function test_a_registered_user_cannot_pass_jwt_auth_with_invalid_data(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $firstUser = User::create([
            'name' => 'Tiffany Doe',
            'email' => 'tiff.doe.test@test.com',
            'password' => 'Password@567890'
        ]);
        $secondUser = User::create([
            'name' => 'Jane Winneyfried Doe',
            'email' => 'jane.doe.test@test.com',
            'password' => 'Password@12345'
        ]);

        $firstResponse = $this->post('/api/auth/login', [
            'email' => 'tiff.doe.test@test.com',
            'password' => '12345'
        ]);
        $secondResponse = $this->post('/api/auth/login', [
            'email' => 'testmail@teeest.test',
            'password' => 'Password@12345'
        ]);

        $firstResponse
            ->assertStatus(401)
            ->assertUnauthorized();
        $secondResponse
            ->assertStatus(401)
            ->assertUnauthorized();
    }

    /** @test */
    public function test_only_jwt_authenticated_user_can_access_api_amd_index(): void
    {

    }
}
