<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface EloquentRepositoryInterface
{
    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * @return Collection
     */
    public function fetchAll(): Collection;
}
