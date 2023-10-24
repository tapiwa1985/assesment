<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(),
            'reason' => $this->faker->sentence(),
            'date_booked' => Carbon::now()
        ];
    }
}
