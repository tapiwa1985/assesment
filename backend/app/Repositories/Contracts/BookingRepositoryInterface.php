<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BookingRepositoryInterface
{
    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * @param int $userId
     * @return Collection|null
     */
    public function fetchByUserId(int $userId): ?Collection;
}
