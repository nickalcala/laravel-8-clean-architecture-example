<?php

namespace Service\Product;

use App\Http\Product\CreateProductRequest;
use App\Http\Product\GetProductPaginationRequest;
use Core\Product\Commands\ICreateProduct;
use Core\Product\Queries\IGetProductPagination;
use Dingo\Api\Http\Response;
use Service\Common\Controller;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->scopes('product.read', ['only' => ['index']]);
        $this->scopes('product.write', ['only' => ['store']]);
    }

    /**
     * @param IGetProductPagination $query
     * @param GetProductPaginationRequest $request
     * @return Response
     * @OA\Get(
     *     path="/products",
     *     summary="List all products",
     *     operationId="index",
     *     tags={"Product"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Products pagination",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/ProductTransformer")
     *         ),
     *     ),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function index(GetProductPaginationRequest $request, IGetProductPagination $query): Response
    {
        $pagination = $query->execute($request->data());
        return $this->response->paginator($pagination, new ProductTransformer(), ['key' => 'product']);
    }

    /**
     * @param CreateProductRequest $request
     * @param ICreateProduct $command
     * @return Response
     * @OA\Post(
     *     path="/products",
     *     summary="New product",
     *     operationId="store",
     *     tags={"Product"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Product object",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/CreateProductRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A product",
     *         @OA\JsonContent(ref="#/components/schemas/ProductTransformer"),
     *     ),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable entity",
     *         @OA\JsonContent(ref="#/components/schemas/CreateProductRequestValidationError")
     *     )
     * )
     */
    public function store(CreateProductRequest $request, ICreateProduct $command): Response
    {
        $product = $command->execute($request->data());
        return $this->response->item($product, new ProductTransformer(), ['key' => 'product']);
    }
}
