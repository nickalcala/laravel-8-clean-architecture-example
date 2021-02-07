<?php

namespace App\Http\Product;

use App\Http\Controllers\Controller;
use Core\Product\Commands\ICreateProduct;
use Core\Product\Queries\IGetProductPagination;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Laravel\Jetstream\Jetstream;

class ProductController extends Controller
{
    public function index(GetProductPaginationRequest $request, IGetProductPagination $query): Response
    {
        $pagination = $query->execute($request->data());

        return Jetstream::inertia()->render($request, 'Home', [
            'pagination' => $pagination
        ]);
    }

    public function store(CreateProductRequest $request, ICreateProduct $command): RedirectResponse
    {
        $command->execute($request->data());
        return redirect()->route('home');
    }
}
