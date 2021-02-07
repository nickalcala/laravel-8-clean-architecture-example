<?php

namespace Service\Product;

use Core\Product\Commands\CreateProductModel;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateProductRequest
 * @package Service\Product
 * @OA\Schema(
 *     schema="CreateProductRequest",
 *     type="object",
 *     title="CreateProductRequest",
 *     required={"name", "description", "price", "image"},
 *     properties={
 *         @OA\Property(property="name", type="string"),
 *         @OA\Property(property="description", type="string"),
 *         @OA\Property(property="price", type="number"),
 *         @OA\Property(property="image", type="string", format="binary")
 *     }
 * )
 * @OA\Schema(
 *     schema="CreateProductRequestValidationError",
 *     type="object",
 *     title="CreateProductRequestValidationError",
 *     properties={
 *         @OA\Property(property="message", type="string", default="The given data was invalid."),
 *         @OA\Property(property="errors", type="object", properties={
 *             @OA\Property(property="name", type="array", @OA\Items(type="string")),
 *             @OA\Property(property="description", type="array", @OA\Items(type="string")),
 *             @OA\Property(property="price", type="array", @OA\Items(type="string")),
 *             @OA\Property(property="image", type="array", @OA\Items(type="string")),
 *         }),
 *         @OA\Property(property="status_code", type="integer", default="422"),
 *     }
 * )
 */
class CreateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image',
        ];
    }

    public function data(): CreateProductModel
    {
        $model = new CreateProductModel();
        $model->name = $this->input('name');
        $model->description = $this->input('description');
        $model->price = floatval($this->input('price'));
        $model->image = $this->file('image');
        return $model;
    }
}
