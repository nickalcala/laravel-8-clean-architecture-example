<?php

namespace Infrastructure\Repository;

use Core\Repository\ICriteria;
use Core\Repository\IRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class Repository implements IRepository
{
    /**
     * @var ICriteria[]
     */
    private array $criteria = [];
    private Builder $query;

    public function __construct()
    {
        $this->begin();
    }

    abstract protected function model(): string;

    protected function begin(): self
    {
        /* @var \Illuminate\Database\Eloquent\Model $model */
        $class = $this->model();
        $model = new $class();
        $this->query = $model->newQuery();
        return $this;
    }

    protected function applyCriteria()
    {
        if (!empty($this->criteria)) {
            foreach ($this->criteria as $c) {
                $c->apply($this->query);
            }
        }
    }

    public function addCriteria(ICriteria $criteria): self
    {
        $this->criteria[spl_object_id($criteria)] = $criteria;
        return $this;
    }

    public function removeCriteria(ICriteria $criteria): self
    {
        unset($this->criteria[spl_object_id($criteria)]);
        return $this;
    }

    public function all(): Collection
    {
        $this->applyCriteria();
        return $this->query->get();
    }

    public function first(): ?Model
    {
        $this->applyCriteria();
        return $this->query->first();
    }

    public function paginator($size = 50, $page = 1): LengthAwarePaginator
    {
        $this->applyCriteria();
        return $this->query->paginate($size, ['*'], 'page', $page);
    }
}
