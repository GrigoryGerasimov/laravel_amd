<?php

namespace Tests\Feature\Web;

use App\Models\User;
use Database\Seeders\{DatabaseSeeder, UserRoleSeeder};
use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use InteractsWithExceptionHandling, WithFaker, RefreshDatabase;

    /** @test */
    public function test_an_unauthenticated_user_cannot_access_amd_index_view(): void
    {
        $this
            ->withoutDeprecationHandling();

        $this->assertGuest();

        $response = $this->get('/articles');

        $response
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /** @test */
    public function test_only_an_authenticated_user_can_access_amd_index_view(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $dummyPassword = $this->faker()->password();

        $credentials = [
            'email' => 'test@test.com',
            'password' => $dummyPassword
        ];

        $user = User::create(array_merge(
            [
                'name' => $this->faker()->firstNameFemale() . $this->faker()->lastName(),
                'password_confirmation' => $dummyPassword
            ],
            $credentials
        ));

        $this->assertDatabaseCount('users', 1);

        $responseLoginGet = $this->get('/login');

        $responseLoginGet
            ->assertStatus(200)
            ->assertOk();

        $responseLoginPost = $this->post('/login', $credentials);

        $responseLoginPost
            ->assertStatus(302)
            ->assertRedirectToRoute('home');

        $this->assertAuthenticatedAs($user);

        $responseAmdIndex = $this->get('/articles');

        $responseAmdIndex
            ->assertStatus(200)
            ->assertSuccessful()
            ->assertViewIs('articles.index')
            ->assertSeeText('No article positions available');
    }

    /** @test */
    public function test_an_authenticated_user_without_creator_role_cannot_create_articles(): void
    {
        $this->seed(DatabaseSeeder::class);

        $credentials = [
            'email' => 'test@testmail.co.uk',
            'password' => 'Password@12345'
        ];

        $user = User::create(array_merge([
            'name' => 'John Doe',
            'password_confirmation' => 'Password@12345'
        ], $credentials));

        $this->seed(UserRoleSeeder::class);
    }

}
