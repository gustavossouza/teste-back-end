<?php

namespace App\Domain\Users\Services;

use App\Domain\Supports\Services\GlobalServices;
use App\Domain\Users\Repositories\UsersRepository;

class UsersService extends GlobalServices
{
    public function __construct(
        protected UsersRepository $repository
    )
    {}
}