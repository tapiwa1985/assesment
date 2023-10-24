<?php

namespace App\Repositories;

use App\Repositories\Contracts\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class EloquentBaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    private Model $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * @return Collection
     */
    public function fetchAll(): Collection
    {
        return $this->model->all();
    }
}
