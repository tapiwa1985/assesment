<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserRepositoryUnitTest extends TestCase
{
    use DatabaseMigrations;

    private UserRepositoryInterface $userRepository;

    /**
     * @return void
     * @throws BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = app()->make(UserRepositoryInterface::class);
    }

    /**
     * @return void
     */
    public function test_find_user_by_email_assert_success(): void
    {
        $user = User::factory()->create();
        $result = $this->userRepository->findByEmail($user->email);
        $this->assertEquals($user->id, $result->id);
        $this->assertEquals($user->email, $result->email);
        $this->assertEquals($user->name, $result->name);
        $this->assertInstanceOf(User::class, $result);
    }
}
