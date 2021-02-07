<?php

namespace Service\Product;

use Core\Product\Queries\GetProductPaginationModel;
use Illuminate\Foundation\Http\FormRequest;

class GetProductPaginationRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function data(): GetProductPaginationModel
    {
        return new GetProductPaginationModel(
            $this->query('page', 1),
            $this->query('name'),
        );
    }
}
