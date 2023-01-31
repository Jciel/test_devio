<?php

namespace services;

use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;
use App\Services\ProductService;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    private Product $productModel;
    private ProductService $productService;
    private OrderService $orderService;
    private Order $orderModel;

    public function setUp(): void
    {
        parent::setUp();

        $this->productService = $this->app->make(ProductService::class);
        $this->orderService = $this->app->make(OrderService::class);
        $this->productModel = $this->app->make(Product::class);
        $this->orderModel = $this->app->make(Order::class);
    }

    public function testGetAll()
    {
        $orders = $this->orderModel->factory(2)->create();
        $ordersIds = $orders->map(fn ($order) => $order->getAttribute('id'));

        $this->assertEquals(2, $this->orderService->getAll()->count());
        $this->assertEqualsCanonicalizing(
            $ordersIds,
            $this->orderService->getAll()->map(fn ($order) => $order->getAttribute('id'))
        );
    }

    public function testGetOrderDone()
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

        $this->assertEquals(1, $this->orderService->getOrderDone()->count());
        $this->assertEquals('Maria', $this->orderService->getOrderDone()[0]->getAttribute('client-name'));
    }

    public function testGetOrderTodo()
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

        $this->assertEquals(1, $this->orderService->getOrderToDo()->count());
        $this->assertEquals('João', $this->orderService->getOrderToDo()[0]->getAttribute('client-name'));
    }

    public function testFinalizeOrder()
    {
        $order = $this->orderModel->factory()->createMany([
            [
                'client-name' => 'Maria',
                'status' => 'TODO'
            ],
            [
                'client-name' => 'João',
                'status' => 'TODO'
            ]
        ])->first();

        $finalizedOrder = $this->orderService->finalizeOrder($order->getAttribute('id'));

        $this->assertEquals("DONE", $finalizedOrder->getAttribute('status'));
    }

    public function testAddProduct()
    {
        $product = $this->productModel->factory()->createMany([
            [
                'name' => 'Hamburger'
            ],
            [
                'name' => 'Coca-Cola'
            ]
        ])->first();

        $order = $this->orderModel->factory(1)->createOne();

        $this->assertEquals(0, $order->getAttribute('products')->count());
        $this->assertEquals([], $order->getAttribute('products')->toArray());

        $orderAdded = $this->orderService->addProduct($order->getAttribute('id'), $product->getAttribute('id'));
        $orderProducts = $orderAdded->getAttribute('products');

        $this->assertEquals(1, $orderProducts->count());
        $this->assertEquals('Hamburger', $orderProducts->first()->getAttribute('name'));
    }

    public function testRemoveProduct()
    {
        $products = $this->productModel->factory()->createMany([
            [
                'name' => 'Hamburger'
            ],
            [
                'name' => 'Coca-Cola'
            ]
        ]);

        $productsIds = $products->map(fn ($product) => $product->getAttribute('id'));
        $order = $this->orderModel->factory(1)->createOne();
        $order->belongsToMany(Product::class, 'order_products')->attach($productsIds);

        $this->assertEquals(2, $order->getAttribute('products')->count());

        $productsIdForRemove = $productsIds[0];
        $orderRemoved = $this->orderService->removeProduct($order->getAttribute('id'), $productsIdForRemove);
        $this->assertEquals(1, $orderRemoved->getAttribute('products')->count());
        $this->assertEquals($productsIds[1], $orderRemoved->getAttribute('products')->first()->getAttribute('id'));
    }
}
