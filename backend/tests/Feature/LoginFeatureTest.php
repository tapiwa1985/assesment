<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class LoginFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('passport:install', ['-vvv' => true]);
        $this->user = User::factory()->create([
            'password' => bcrypt('secret')
        ]);
    }

    /**
     * @return void
     */
    public function test_user_login_assert_ok(): void
    {
        $response = $this->json('POST', '/api/v1/login', [
            'email' => $this->user->email,
            'password' => 'secret'
        ]);
        $response->assertOk();
        $response->assertJsonStructure([
            'token',
            'user'
        ]);
    }

    /**
     * @return void
     */
    public function test_user_login_when_user_email_does_not_exist_assert_unauthorised(): void
    {
        $response = $this->json('POST', '/api/v1/login', [
            'email' => 'test@test.com',
            'password' => 'secret'
        ]);
        $response->assertUnauthorized();
    }

    /**
     * @return void
     */
    public function test_user_login_when_password_is_incorrect_assert_unauthorised(): void
    {
        $response = $this->json('POST', '/api/v1/login', [
            'email' => $this->user->email,
            'password' => 'incorrect password'
        ]);
        $response->assertUnauthorized();
    }

    /**
     * @return void
     */
    public function test_user_login_when_email_is_empty_assert_unprocessable(): void
    {
        $response = $this->json('POST', '/api/v1/login', [
            'email' => '',
            'password' => 'secret'
        ]);
        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'email' => [
                    'The email field is required.'
                ]
            ]
        ]);
    }

    /**
     * @return void
     */
    public function test_user_login_when_email_is_not_valid_assert_unprocessable(): void
    {
        $response = $this->json('POST', '/api/v1/login', [
            'email' => 'invalid-email',
            'password' => 'secret'
        ]);
        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'email' => [
                    'The email field must be a valid email address.'
                ]
            ]
        ]);
    }

    /**
     * @return void
     */
    public function test_user_login_when_password_is_empty_assert_unprocessable(): void
    {
        $response = $this->json('POST', '/api/v1/login', [
            'email' => $this->user->email,
            'password' => ''
        ]);
        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'password' => [
                    'The password field is required.'
                ]
            ]
        ]);
    }
}
