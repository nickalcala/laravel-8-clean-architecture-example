<?php

use Dingo\Api\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* @var Router $api */
$api = app(Router::class);

$api->group([
    'version' => 'v1',
    'middleware' => 'api.auth',
    'namespace' => 'Service',
], function (Router $api) {
    $api->get('products', 'Product\ProductController@index');
    $api->post('products', 'Product\ProductController@store');
});
