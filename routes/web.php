<?php

use OpenApi\Annotations\OpenApi as OA;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->group(['prefix' => 'products'], function () use ($router) {
        $router->get('/', '\App\Http\Controllers\ProductController@index');
        $router->get('/search', '\App\Http\Controllers\ProductController@search');
    });

    $router->group(['prefix' => 'order'], function () use ($router) {
        $router->get('/', '\App\Http\Controllers\OrderController@index');
        $router->get('todo', '\App\Http\Controllers\OrderController@getOrderToDo');
        $router->get('done', '\App\Http\Controllers\OrderController@getOrderDone');
        $router->patch('{id}/finalize-order', '\App\Http\Controllers\OrderController@finalizeOrder');
        $router->post('{id}/add-product', '\App\Http\Controllers\OrderController@addProduct');
        $router->post('{id}/remove-product', '\App\Http\Controllers\OrderController@removeProduct');
    });
});
