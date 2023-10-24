<?php

namespace Tests\Unit;

use App\Models\Booking;
use App\Models\User;
use App\Repositories\Contracts\BookingRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Collection;
use Tests\TestCase;

class BooingRepositoryUnitTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var BookingRepositoryInterface
     */
    private BookingRepositoryInterface $bookingRepository;

    /**
     * @return void
     * @throws BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->bookingRepository = app()->make(BookingRepositoryInterface::class);
    }

    /**
     * @return void
     */
    public function test_create_new_booking_assert_saved_in_database(): void
    {
        $reason = $this->faker->sentence();
        $user = User::factory()->create();
        $date = Carbon::now();
        $booking = $this->bookingRepository->create([
            'reason' => $reason,
            'user_id' => $user->id,
            'date_booked' => $date
        ]);
        $this->assertDatabaseHas('bookings', [
            'reason' => $reason,
            'user_id' => $user->id,
            'date_booked' => $date
        ]);
        $this->assertInstanceOf(Booking::class, $booking);
    }

    /**
     * @return void
     */
    public function test_list_bookings_for_user_assert_collection(): void
    {
        $user = User::factory()->create();
        Booking::factory(5)->create([
            'user_id' => $user->id
        ]);
        $collection = $this->bookingRepository->fetchByUserId($user->id);
        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertEquals(5, $collection->count());
    }

    /**
     * @return void
     */
    public function test_fetch_all_bookings_assert_collection(): void
    {
        Booking::factory(5)->create();
        $collection = $this->bookingRepository->fetchAll();
        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertEquals(5, $collection->count());
    }
}
