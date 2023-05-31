<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\{WithFaker, RefreshDatabase};
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Tests\TestCase;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

final class AuthApiTest extends TestCase
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

        User::create(['name' => 'James Sutherland', ...$credentials]);

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

        User::create([
            'name' => 'Tiffany Doe',
            'email' => 'tiff.doe.test@test.com',
            'password' => 'Password@567890'
        ]);
        User::create([
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
            ->assertUnauthorized()
            ->assertExactJson([
                'error' => 'Unauthorized'
            ]);
        $secondResponse
            ->assertStatus(401)
            ->assertUnauthorized()
            ->assertExactJson([
                'error' => 'Unauthorized'
            ]);
    }

    /** @test */
    public function test_a_signed_in_user_can_sign_out(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $credentials = [
            'email' => 'test.user@test.te',
            'password' => 'Password@12345'
        ];

        $user = User::create([
            'name' => 'Test User',
            ...$credentials
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test.user@test.te'
        ]);

        $token = auth('api')->attempt($credentials);

        $this
            ->actingAs($user)
            ->withHeader('Authorization', "Bearer $token")
            ->post('/api/auth/logout')
            ->assertStatus(200)
            ->assertOk()
            ->assertExactJson([
                'message' => 'Sign out successful'
            ]);
    }

    /** @test */
    public function test_an_unauthenticated_user_cannot_sign_out(): void
    {
        $credentials = [
            'email' => 'test.user@test.te',
            'password' => 'Password@12345'
        ];

        $user = User::create([
            'name' => 'Test User',
            ...$credentials
        ]);

        $this
            ->actingAs($user)
            ->post('/api/auth/logout')
            ->assertStatus(302)
            ->assertRedirectToRoute('login');
    }

    /** @test */
    public function test_a_jwt_token_can_get_refreshed(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $credentials = [
            'email' => 'test.user@test.te',
            'password' => 'Password@12345'
        ];

        $user = User::create([
            'name' => 'Test User',
            ...$credentials
        ]);

        $accessToken = auth('api')->attempt($credentials);

        $refreshToken = auth('api')->refresh();

        $this->assertNotEquals($accessToken, $refreshToken);

        $this
            ->actingAs($user)
            ->post('/api/auth/login', $credentials)
            ->assertStatus(200)
            ->assertOk()
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in'
            ]);

        $this
            ->actingAs($user)
            ->post('/api/auth/refresh')
            ->assertStatus(200)
            ->assertSuccessful()
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in'
            ]);
    }

    /** @test */
    public function test_a_jwt_token_is_invalid_after_expire_time_elapsed(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $credentials = [
            'email' => 'test.user@test.te',
            'password' => 'Password@12345'
        ];

        $user = User::create([
            'name' => 'Test User',
            ...$credentials
        ]);

        $token = [
            'access_token' => auth('api')->attempt($credentials),
            'token_type' => 'bearer',
            'expires_in' => 3600
        ];

        $this
            ->actingAs($user)
            ->withHeader('Authorization', "Bearer {$token['access_token']}")
            ->get('/api/articles')
            ->assertStatus(200)
            ->assertOk();

        $this->travelTo(now()->addSeconds(3700));

        $this->expectException(UnauthorizedHttpException::class);
        $this->expectExceptionMessage('Token has expired');

        $this
            ->actingAs($user)
            ->withHeader('Authorization', "Bearer {$token['access_token']}")
            ->get('/api/articles');
    }
}
