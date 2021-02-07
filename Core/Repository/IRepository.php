<?php

namespace Core\Repository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IRepository
{
    public function addCriteria(ICriteria $criteria): self;

    public function removeCriteria(ICriteria $criteria): self;

    public function all(): Collection;

    public function first(): ?Model;

    public function paginator($size = 50, $page = 1): LengthAwarePaginator;
}
