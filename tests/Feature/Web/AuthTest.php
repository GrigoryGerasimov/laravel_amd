<?php

namespace Tests\Feature\Web;

use App\Jobs\SendRegistrationMailJob;
use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};
use Illuminate\Support\Facades\{Queue};
use Tests\TestCase;

final class AuthTest extends TestCase
{
    use InteractsWithExceptionHandling, WithFaker, RefreshDatabase;

    /** @test */
    public function test_a_user_can_access_registration_form(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $response = $this->get('/register');

        $response
            ->assertStatus(200)
            ->assertOk()
            ->assertViewIs('auth.register')
            ->assertSee('Register');
    }

    /** @test */
    public function test_a_user_can_sign_up(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $testingEmail = 'test.user@testing.com';
        $testingPassword = $this->faker()->password(8, 30);

        $user = [
            'name' => $this->faker()->firstNameMale() . $this->faker()->lastName(),
            'email' => $testingEmail,
            'password' => $testingPassword,
            'password_confirmation' => $testingPassword
        ];

        $response = $this->post('/register', $user);

        $this
            ->assertDatabaseCount('users', 1)
            ->assertDatabaseHas('users', ['email' => $testingEmail]);

        $response
            ->assertStatus(302)
            ->assertRedirectToRoute('home')
            ->assertCookie('laravel_session')
            ->assertCookie('XSRF-TOKEN');
    }

    /** @test */
    public function test_a_user_cannot_sign_up_with_invalid_data(): void
    {
        $this
            ->withoutDeprecationHandling();

        $firstUser = $this->post('/register', [
            'name' => 'Uncreated User 1',
            'email' => $this->faker()->unique()->safeEmail(),
            'password' => $this->faker()->password(7, 10)
        ]);

        $secondUser = $this->post('/register', [
            'name' => 'Uncreated User 2',
            'email' => 'test',
            'password' => '___'
        ]);

        $this
            ->assertDatabaseCount('users', 0)
            ->assertDatabaseMissing('users', ['name' => 'Uncreated User 1'])
            ->assertDatabaseMissing('users', ['name' => 'Uncreated User 2'])
            ->assertDatabaseEmpty('users');
    }

    /** @test */
    public function test_a_registration_email_sent_to_the_newly_registered_user(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        Queue::fake();

        $testingPassword = $this->faker()->password(8, 30);

        $user = [
            'name' => $this->faker()->firstNameMale() . $this->faker()->lastName(),
            'email' => $this->faker()->unique()->safeEmail(),
            'password' => $testingPassword,
            'password_confirmation' => $testingPassword
        ];

        $this->post('/register', $user);

        Queue::assertPushed(SendRegistrationMailJob::class, 1);
    }

    /** @test */
    public function test_a_user_can_access_login_form(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $response = $this->get('/login');

        $response
            ->assertOk()
            ->assertStatus(200)
            ->assertViewIs('auth.login')
            ->assertSeeInOrder([
                'Login',
                'Email Address',
                'Password',
                'Remember Me'
            ]);
    }

    /** @test */
    public function test_a_user_can_sign_in(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@test.co.uk',
            'password' => 'Password@12345',
            'password_confirmation' => 'Password@12345'
        ]);

        $this
            ->assertDatabaseCount('users', 1)
            ->assertDatabaseHas('users', ['email' => 'testuser@test.co.uk']);

        $credentials = [
            'email' => $user->email,
            'password' => 'Password@12345'
        ];

        $this->assertCredentials($credentials);

        $loggingIn = $this->post('/login', $credentials);

        $loggingIn
            ->assertRedirectToRoute('home')
            ->assertStatus(302);

        $loggedIn = $this->get('/home');

        $loggedIn
            ->assertViewIs('home')
            ->assertSeeText([
                'You are logged in!',
                'A registration email has already been sent to you registered email address'
            ]);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function test_a_user_cannot_sign_in_with_invalid_data(): void
    {
        $this
            ->withoutDeprecationHandling();

        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@test.com',
            'password' => '!Password123!',
            'password_confirmation' => '!Password123!'
        ]);

        $this
            ->assertDatabaseCount('users', 1)
            ->assertDatabaseHas('users', ['email' => 'testuser@test.com']);

        $credentialsWithInvalidEmail = [
            'email' => 'testuser111@test.com',
            'password' => '!Password123!'
        ];

        $credentialsWithInvalidPassword = [
            'email' => 'testuser@test.com',
            'password' => 'Password@12345'
        ];

        $credentialsWithInvalidEmailAndPassword = [
            'email' => 'testuser12345@test.com',
            'password' => 'Password@12345'
        ];

        $responseInvalidEmail = $this->post('/login', $credentialsWithInvalidEmail);
        $responseInvalidPassword = $this->post('/login', $credentialsWithInvalidPassword);
        $responseInvalidCredentials = $this->post('/login', $credentialsWithInvalidEmailAndPassword);

        $this
            ->assertGuest();

        $responseInvalidEmail
            ->assertStatus(302)
            ->assertRedirect('/')
            ->assertInvalid(['email' => 'These credentials do not match our records.']);

        $responseInvalidPassword
            ->assertStatus(302)
            ->assertRedirect('/')
            ->assertInvalid(['email' => 'These credentials do not match our records.']);

        $responseInvalidCredentials
            ->assertStatus(302)
            ->assertRedirect('/')
            ->assertInvalid(['email' => 'These credentials do not match our records.']);
    }

    /** @test */
    public function test_a_user_can_access_logout_option(): void
    {
        $this->test_a_user_can_sign_in();

        $this->assertAuthenticated();

        $response = $this->get('/home');

        $response
            ->assertStatus(200)
            ->assertOk()
            ->assertSee(['Test User', 'Logout']);
    }

    /** @test */
    public function test_a_user_can_sign_out(): void
    {
        $this->test_a_user_can_access_logout_option();

        $loggingOut = $this->post('/logout');

        $loggingOut
            ->assertRedirect('/')
            ->assertStatus(302);

        $this->assertGuest();
    }

    /** @test */
    public function test_a_user_can_access_password_reset_form(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $this->assertGuest();

        $response = $this->get('/login');

        $response
            ->assertStatus(200)
            ->assertOk()
            ->assertViewIs('auth.login')
            ->assertSee('Forgot Your Password?');

        $resettingPassword = $this->get('/password/reset');

        $resettingPassword
            ->assertStatus(200)
            ->assertSuccessful()
            ->assertViewIs('auth.passwords.email')
            ->assertSee(['Email Address', 'Send Password Reset Link'])
            ->assertDontSee('Password Confirmation');
    }
}
