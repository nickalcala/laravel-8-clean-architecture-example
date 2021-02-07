<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Page\PageController@index');

Route::group([
    'middleware' => ['auth:sanctum', 'verified'],
], function () {
    Route::get('home', 'App\Http\Product\ProductController@index')->name('home');

    Route::post('products/store', 'App\Http\Product\ProductController@store')->name('product.store');
    Route::inertia('products/create', 'Product/CreateProduct')->name('product.create');
});
