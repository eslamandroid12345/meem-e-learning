<?php

namespace App\Repository;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function getAll(array $columns = ['*'], array $relations = [], Closure $addition = null , Closure $filters = null , $orderBy = "ASC"): Collection;

    public function getActive(array $columns = ['*'], array $relations = [], Closure $addition = null): Collection;

    public function getById(
          $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model;

    public function get(
        $byColumn,
        $value,
        array $columns = ['*'],
        array $relations = [],
        $orderBy = 'ASC'
    ): array|Collection;

    public function first(
        $byColumn,
        $value,
        array $columns = ['*'],
        array $relations = [],
    ): Builder|Model;

    public function create(array $payload): ?Model;

    public function insert(array $payload): bool;

    public function getFirst(): ?Model;

    public function update($modelId, array $payload): bool;

    public function delete($modelId, array $filesFields): bool;

    public function paginate(int $perPage = 10, array $relations = [] , $orderBy = 'ASC' , $columns = ['*'], Closure $addition = null , Closure $filters = null);

    public function whereHasMorph($relation, $class);
}
