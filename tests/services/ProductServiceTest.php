<?php

namespace services;

use App\Models\Product;
use App\Services\ProductService;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Money\Money;
use Tests\TestCase;

class ProductServiceTest extends TestCase
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

    public function testGetAll()
    {
        $products = $this->productModel->factory(2)->create();
        $productsIds = $products->map(fn ($product) => $product->id);

        $this->assertEquals(2, $this->productService->getAll()->count());
        $this->assertEqualsCanonicalizing(
            $productsIds,
            $this->productService->getAll()->map(fn ($product) => $product->id)
        );
    }

    public function testSearchByName()
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

        $this->assertEquals(1, $this->productService->search('ria')->count());
        $this->assertEquals('Maria', $this->productService->search('ria')[0]->getAttribute('name'));
        $this->assertEquals(0, $this->productService->search('jos')->count());
        $this->assertEquals([], $this->productService->search('jos')->toArray());
    }

    public function testSearchByCode()
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

        $this->assertEquals(1, $this->productService->search(123)->count());
        $this->assertEquals('Maria', $this->productService->search(123)[0]->getAttribute('name'));
        $this->assertEquals(0, $this->productService->search(111)->count());
        $this->assertEquals([], $this->productService->search(111)->toArray());
    }
}
