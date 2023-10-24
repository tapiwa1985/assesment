<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Repositories\Contracts\BookingRepositoryInterface;
use Illuminate\Support\Collection;

class BookingRepository extends EloquentBaseRepository implements BookingRepositoryInterface
{
    /**
     * @var Booking $model
     */
    private Booking $model;

    /**
     * @param Booking $model
     */
    public function __construct(Booking $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param int $userId
     * @return Collection|null
     */
    public function fetchByUserId(int $userId): ?Collection
    {
        return $this->model->where('user_id', $userId)
            ->get();
    }
}
