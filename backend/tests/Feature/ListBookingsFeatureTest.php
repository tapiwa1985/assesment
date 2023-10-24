<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ListBookingsFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_list_bookings_assert_ok(): void
    {
        $user = User::factory()->create();
        Booking::factory(5)->create([
            'user_id' => $user->id
        ]);
        Passport::actingAs($user);
        $response = $this->get('/api/v1/bookings');
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'reason',
                    'date_booked',
                    'user' => [
                        'name',
                        'email'
                    ]
                ]
            ]
        ]);
        $response
            ->assertJson(
                fn(AssertableJson $json) => $json->has('data', 5)
            );
    }
}
