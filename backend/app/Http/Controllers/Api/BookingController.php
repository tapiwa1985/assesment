<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookingRequest;
use App\Http\Resources\BookingResource;
use App\Http\Resources\BookingResourceCollection;
use App\Repositories\Contracts\BookingRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends Controller
{
    /**
     * @var BookingRepositoryInterface $bookingRepository
     */
    private BookingRepositoryInterface $bookingRepository;

    /**
     * @param BookingRepositoryInterface $bookingRepository
     */
    public function __construct(BookingRepositoryInterface $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * @return BookingResourceCollection
     */
    public function index(): BookingResourceCollection
    {
        $bookings = $this->bookingRepository->fetchAll();

        return new BookingResourceCollection($bookings);
    }

    /**
     * @param CreateBookingRequest $request
     * @return JsonResponse
     */
    public function store(CreateBookingRequest $request): JsonResponse
    {
        $data = $request->only('reason', 'date_booked');
        $data['user_id'] = auth()->user()->id;
        $booking = $this->bookingRepository->create($data);

        return (new BookingResource($booking))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
