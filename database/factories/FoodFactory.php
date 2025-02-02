<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Food;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * The name of the model that is associated with this factory.
     *
     * @var string
     */
    protected $model = Food::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'category' => $this->faker->randomElement([
                'Main Meals', 'Snacks', 'Desserts', 'Beverages'
            ]),
            'description' => $this->faker->sentence(),
            'image_path' => 'images/sample.jpg', // You can replace this with a real image path
            'price' => $this->faker->randomFloat(2, 10, 500), // Price between 10.00 and 500.00
            'stock_level' => $this->faker->numberBetween(1, 100),
        ];
    }
}
