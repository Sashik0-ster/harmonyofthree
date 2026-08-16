<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface ProfileRepositoryInterface
{
    public function find(int $userId): User;

    public function update(User $user, array $data): User;
}
