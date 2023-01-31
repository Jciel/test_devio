<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsA = Product::paginate(20);
        $orders = Order::paginate(15);

        foreach ($orders as $order) {
            $products = $productsA->random(4);
            foreach ($products as $product) {
                OrderProduct::firstOrCreate([
                    'product_id' => $product->id,
                    'order_id' => $order->id,
                ]);
            }
        }
    }
}
