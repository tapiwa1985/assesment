<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CreateBookingFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_create_booking_assert_created(): void
    {
        $user = User::factory()->create();
        $reason = $this->faker->sentence();
        $dateBooked = Carbon::createFromFormat('Y-m-d H:i:s', now())
            ->addDays(3)
            ->toDateTimeString();
        Passport::actingAs($user);
        $response = $this->json('POST', '/api/v1/bookings', [
            'reason' => $reason,
            'date_booked' => $dateBooked
        ]);
        $response->assertCreated();
    }

    /**
     * @return void
     */
    public function test_create_when_reason_is_empty_assert_validation_error(): void
    {
        $user = User::factory()->create();
        $dateBooked = Carbon::now()->addDays(3);
        Passport::actingAs($user);
        $response = $this->json('POST', '/api/v1/bookings', [
            'reason' => '',
            'date_booked' => $dateBooked
        ]);
        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'reason' => [
                    'The reason field is required.'
                ]
            ]
        ]);
    }

    /**
     * @return void
     */
    public function test_create_booking_when_date_booked_is_empty_assert_validation_error(): void
    {
        $user = User::factory()->create();
        $reason = $this->faker->sentence();
        Passport::actingAs($user);
        $response = $this->json('POST', '/api/v1/bookings', [
            'reason' => $reason,
            'date_booked' => ''
        ]);
        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'date_booked' => [
                    'The date booked field is required.'
                ]
            ]
        ]);
    }

    /**
     * @return void
     */
    public function test_create_booking_when_date_booked_is_not_a_valid_date_assert_unprocessable(): void
    {
        $user = User::factory()->create();
        $reason = $this->faker->sentence();
        Passport::actingAs($user);
        $response = $this->json('POST', '/api/v1/bookings', [
            'reason' => $reason,
            'date_booked' => 'invalid-date'
        ]);
        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'date_booked' => [
                    'The date booked field must be a valid date.'
                ]
            ]
        ]);
    }

    /**
     * @return void
     */
    public function test_create_booking_when_date_booked_is_in_the_past_assert_unprocessable(): void
    {
        $user = User::factory()->create();
        $reason = $this->faker->sentence();
        Passport::actingAs($user);
        $response = $this->json('POST', '/api/v1/bookings', [
            'reason' => $reason,
            'date_booked' => Carbon::createFromFormat('Y-m-d H:i:s', now())
                ->subDays(3)
                ->toDateTimeString()
        ]);
        $response->assertUnprocessable();
        $response->assertJsonStructure([
            'errors' => [
                'date_booked'
            ]
        ]);
    }
}
