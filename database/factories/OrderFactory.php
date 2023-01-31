<?php

namespace Database\Factories;

use App\Model;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Money\Money;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
    	return [
            'client-name' => $this->faker->unique()->name,
            'total' => Money::BRL($this->faker->numberBetween(300, 500)),
            'change' => Money::BRL($this->faker->numberBetween(300, 500)),
            'status' => $this->faker->randomElement(['TODO', 'DONE'])
    	];
    }
}
