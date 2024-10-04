<?php

namespace App\Domain\Supports\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class GlobalRepositories
{
    public function __construct(
        protected Model $entity
    )
    {}

    public function query(): Builder
    {
        return $this->entity->newQuery();
    }

    public function get(): Collection
    {
        return $this->entity->get();
    }

    public function getById(int $id): ?Model
    {
        return $this->entity
            ->where('id', $id)
            ->first();
    }

    public function create(array $data): Model
    {
        $model = new $this->entity;
        $model->fill($data);
        $model->save();
        return $model;
    }

    public function update(int $id, array $data): ?Model
    {
        $model = $this->entity->find($id);
        if (!$model) {
            return null;
        }
    
        $model->update($data);
        return $model;
    }

    public function delete(int $id): ?Model
    {
        $model = $this->entity->find($id);
        if (!$model) {
            return null;
        }

        $model->delete();
        return $model;
    }

    public function count(): int
    {
        return $this->entity->count();
    }

    public function hasDuplicateInColumn(array $columnsValue, ?int $excludeId = null): bool
    {
        $query = $this->entity->where($columnsValue);
    
        if ($excludeId !== null) {
            $query->where('id', '!=', $excludeId);  // Exclui o registro atual da verificação, se fornecido
        }
        
        return $query->exists();
    }
}