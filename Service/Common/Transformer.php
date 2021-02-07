<?php

namespace Service\Common;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

abstract class Transformer extends TransformerAbstract
{
    abstract function attributes(Model $model): array;

    public function transform(Model $model)
    {
        $columns = $model->getAttributes();
        $attributes = [];

        if (array_key_exists('id', $columns)) {
            $attributes['id'] = $model->id;
        }

        if (array_key_exists('created_at', $columns)) {
            $attributes['created_at'] = optional($model->created_at)->format('Y-m-d H:i:s');
        }

        if (array_key_exists('updated_at', $columns)) {
            $attributes['updated_at'] = optional($model->updated_at)->format('Y-m-d H:i:s');
        }

        return array_merge($attributes, $this->attributes($model));
    }
}
