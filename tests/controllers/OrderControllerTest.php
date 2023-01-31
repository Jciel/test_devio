<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    private Product $productModel;
    private Order $orderModel;
    private OrderService $orderService;

    public function setUp(): void
    {
        parent::setUp();

        $this->orderService = $this->app->make(OrderService::class);
        $this->orderModel = $this->app->make(Order::class);
        $this->productModel = $this->app->make(Product::class);
    }

    public function testOrderIndex()
    {
        $orders = $this->orderModel->factory(2)->create();

        $this->get('/v1/order');

        $this->assertResponseOk();
        $this->seeJsonContains(['id' => $orders[0]->id]);
        $this->seeJsonContains(['id' => $orders[1]->id]);
    }

    public function testOrderTodo()
    {
        $orders = $this->orderModel->factory()->createMany([
            [
                'client-name' => 'Maria',
                'status' => 'DONE'
            ],
            [
                'client-name' => 'João',
                'status' => 'TODO'
            ]
        ]);

        $this->json('GET', '/v1/order/todo')
            ->seeJsonContains(['id' => $orders[1]->id])
            ->seeJsonContains(['id' => $orders[0]->id], true);

        $this->assertResponseOk();
        $resArray = json_decode($this->response->getContent(), true);
        $this->assertEquals(1, count($resArray));
    }

    public function testOrderDone()
    {
        $orders = $this->orderModel->factory()->createMany([
            [
                'client-name' => 'Maria',
                'status' => 'DONE'
            ],
            [
                'client-name' => 'João',
                'status' => 'TODO'
            ]
        ]);

        $this->json('GET', '/v1/order/done')
            ->seeJsonContains(['id' => $orders[0]->id])
            ->seeJsonContains(['id' => $orders[1]->id], true);

        $this->assertResponseOk();
        $resArray = json_decode($this->response->getContent(), true);
        $this->assertEquals(1, count($resArray));
    }

    public function testFinalizeOrder()
    {
        $orders = $this->orderModel->factory()->createMany([
            [
                'client-name' => 'Maria',
                'status' => 'TODO'
            ],
            [
                'client-name' => 'João',
                'status' => 'DONE'
            ]
        ]);
        $this->json('PATCH', "/v1/order/{$orders[0]->id}/finalize-order")
            ->seeJsonContains(['id' => $orders[0]->id])
            ->seeJsonContains(['status' => 'DONE']);

        $this->assertResponseOk();
        $resArray = json_decode($this->response->getContent(), true);
        $this->assertEquals($orders[0]->getAttribute('client-name'), $resArray['client-name']);
        $this->assertEquals(2, $this->orderService->getOrderDone()->count());
    }

    public function testOrderAddProduct()
    {
        $product = $this->productModel
            ->factory()
            ->createMany([['name' => 'Hamburger'], ['name' => 'Coca-Cola']])
            ->first();

        $order = $this->orderModel->factory(1)->createOne();

        $this->assertEquals(0, $order->getAttribute('products')->count());
        $this->assertEquals([], $order->getAttribute('products')->toArray());

        $this->post("/v1/order/{$order->id}/add-product", ["product_id" => $product->id]);

        $this->assertResponseOk();
        $this->seeInDatabase('order_products', [
            'product_id' => $product->id,
            'order_id' => $order->id
        ]);
        $resArray = json_decode($this->response->getContent(), true);
        $this->assertEquals(1, count($resArray['products']));
        $this->assertEquals($product->id, $resArray['products'][0]['id']);
    }

    public function testOrderRemoveProduct()
    {
        $products = $this->productModel
            ->factory()
            ->createMany([['name' => 'Hamburger'], ['name' => 'Coca-Cola']]);

        $productsIds = $products->map(fn ($product) => $product->id);
        $order = $this->orderModel->factory(1)->createOne();
        $order->belongsToMany(Product::class, 'order_products')->attach($productsIds);

        $this->assertEquals(2, $order->getAttribute('products')->count());

        $this->post("/v1/order/{$order->id}/remove-product", ["product_id" => $productsIds[0]]);
        $this->assertResponseOk();
        $resArray = json_decode($this->response->getContent(), true);
        $this->assertEquals(1, count($resArray['products']));
        $this->assertEquals($productsIds[1], $resArray['products'][0]['id']);
    }
}
