<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;
}
