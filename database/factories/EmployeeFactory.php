<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * The name of the model that is associated with this factory.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'employee_id' => $this->faker->unique()->randomNumber(5),
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'nic_no' => $this->faker->regexify('[0-9]{9}[Vv]'), // Generates NIC with 9 digits + V
            'type' => $this->faker->randomElement(['Manager', 'Cashier', 'Chef', 'Waiter']),
            'address' => $this->faker->address(),
            'date' => $this->faker->date(),
            'status' => 'Available', // Default status
            'is_available' => $this->faker->boolean(),
        ];
    }
}
