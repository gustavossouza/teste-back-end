<?php

namespace App\Domain\Users\Services;

use App\Domain\Supports\Services\GlobalServices;
use App\Domain\Users\Repositories\UsersRepository;
use App\Domain\Users\Entities\Users;

class UsersService extends GlobalServices
{
    public function __construct(
        protected UsersRepository $repository
    )
    {}

    public function getByEmail(string $email): ?Users
    {
        return $this->repository->getByEmail($email);
    }

    
}