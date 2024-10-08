<?php

namespace App\Domain\Users\Repositories;

use App\Domain\Supports\Repositories\GlobalRepositories;
use App\Domain\Users\Entities\Users;

class UsersRepository extends GlobalRepositories
{
    public function __construct(Users $users)
    {
        parent::__construct($users);
    }

    public function getByEmail(string $email): ?Users
    {
        return $this->entity
            ->where('email', $email)
            ->first();
    }
}