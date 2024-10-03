<?php

namespace App\Domain\Users\Services;

use App\Domain\Supports\Services\GlobalServices;
use App\Domain\Users\Repositories\UsersRepository;
use App\Domain\Users\Entities\Users;
use Hash;

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

    public function create(array $data): Users
    {
        if ($this->isDuplicate(['email' => $data['email']])) {
            throw new \Exception('Este email já está em uso.');
        }
        $data['password'] = Hash::make($data['password']);

        return parent::create($data);
    }

    public function update(array $data, int $userId): Users
    {
        if ($this->isDuplicate(['email' => $data['email']])) {
            throw new \Exception('Este email já está em uso.');
        }
        $data['password'] = Hash::make($data['password']);

        return parent::update($data, $userId);
    }
    
}