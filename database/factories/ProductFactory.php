<?php

namespace Database\Factories;

use App\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Money\Money;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name,
            'code' => $this->faker->numberBetween(100, 200),
            'price' => Money::BRL($this->faker->numberBetween(300, 500)),
            'image' => $this->faker->image(null, 360, 360, 'foods'),
            'description' => $this->faker->text(50)
        ];
    }
}
