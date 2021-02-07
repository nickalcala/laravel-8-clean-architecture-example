<?php

namespace Core\Product\Queries;

class GetProductPaginationModel
{
    public int $page = 1;
    public ?string $name;

    public function __construct(int $page, ?string $name = null)
    {
        $this->page = $page;
        $this->name = $name;
    }

}
