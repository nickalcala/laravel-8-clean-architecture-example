<?php

namespace Service\Product;

use Common\Date\DateHelper;
use Illuminate\Database\Eloquent\Model;
use Service\Common\Transformer;

/**
 * Class ProductTransformer
 * @package Service\Product
 * @OA\Schema(
 *     schema="ProductTransformer",
 *     type="object",
 *     title="ProductTransformer",
 *     properties={
 *         @OA\Property(property="id", type="integer"),
 *         @OA\Property(property="attributes", type="object", properties={
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="description", type="string"),
 *             @OA\Property(property="price", type="number"),
 *             @OA\Property(property="image", type="string"),
 *             @OA\Property(property="moment", type="string")
 *         }),
 *         @OA\Property(property="relationships", type="array", @OA\Items({
 *
 *         })),
 *     }
 * )
 */
class ProductTransformer extends Transformer
{
    function attributes(Model $model): array
    {
        return [
            'name' => $model->name,
            'description' => $model->description,
            'price' => floatval($model->price),
            'image' => $model->image,
            'moment' => DateHelper::getMoment($model->created_at)
        ];
    }
}
