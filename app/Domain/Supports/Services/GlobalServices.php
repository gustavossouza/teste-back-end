<?php

namespace App\Domain\Supports\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GlobalServices
{
    public function get(): Collection
    {
        return $this->repository->get();
    }

    public function getById(int $id): ?Model
    {
        return $this->repository->getById($id);
    }

    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): ?Model
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): ?Model
    {
        return $this->repository->delete($id);
    }

    public function isDuplicate(array $columnsValue): bool
    {
        return $this->repository
            ->hasDuplicateInColumn($columnsValue);
    }
}