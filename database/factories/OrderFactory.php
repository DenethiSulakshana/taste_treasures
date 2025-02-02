<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * The name of the model that is associated with this factory.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Creates a new user if none exists
            'name' => $this->faker->name(),
            'delivery_option' => $this->faker->randomElement(['Pickup', 'Home Delivery']),
            'address' => $this->faker->address(),
            'total' => $this->faker->randomFloat(2, 100, 2000), // Order total between 100 and 2000
            'is_completed' => $this->faker->boolean(80), // 80% chance of being completed
            'status' => function (array $attributes) {
                return $attributes['is_completed'] ? 'completed' : 'cancelled';
            },
        ];
    }
}
