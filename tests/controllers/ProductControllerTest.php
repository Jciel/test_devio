<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Money\Money;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    private Product $productModel;
    private ProductService $productService;

    public function setUp(): void
    {
        parent::setUp();

        $this->productService = $this->app->make(ProductService::class);
        $this->productModel = $this->app->make(Product::class);
    }

    public function testProductIndex()
    {
        $products = $this->productModel->factory(2)->create();

        $this->get('/v1/products');

        $this->assertResponseOk();
        $this->seeJsonContains(['id' => $products[0]->id]);
        $this->seeJsonContains(['id' => $products[1]->id]);
    }

    public function testProductSearchByName()
    {
        $product = $this->productModel->factory()->createMany([
            [
                'name' => 'Maria',
                'code' => 12345,
                'price' => Money::BRL(10),
                'image' => '/tem/imagename.jpg',
                'description' => 'test'
            ],
            [
                'name' => 'João',
                'code' => 4444,
                'price' => Money::BRL(15),
                'image' => '/tem/imagename2.jpg',
                'description' => 'test2'
            ]
        ]);

        $this->json('GET', '/v1/products/search', ['q' => 'ria'])
            ->seeJsonContains(['id' => $product[0]->id]);

        $resArray = json_decode($this->response->getContent(), true);
        $this->assertEquals($product[0]->getAttribute('name'), $resArray[0]['name']);
        $this->assertEquals(1, count($resArray));
    }

    public function testProductSearchByCode()
    {
        $product = $this->productModel->factory()->createMany([
            [
                'name' => 'Maria',
                'code' => 12345,
                'price' => Money::BRL(10),
                'image' => '/tem/imagename.jpg',
                'description' => 'test'
            ],
            [
                'name' => 'João',
                'code' => 4444,
                'price' => Money::BRL(15),
                'image' => '/tem/imagename2.jpg',
                'description' => 'test2'
            ]
        ]);

        $this->json('GET', '/v1/products/search', ['q' => 44])
            ->seeJsonContains(['id' => $product[1]->id]);

        $resArray = json_decode($this->response->getContent(), true);
        $this->assertEquals($product[1]->getAttribute('name'), $resArray[0]['name']);
        $this->assertEquals(1, count($resArray));
    }
}
