<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
//use App\Models\Employee;
//use App\Models\Order;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create(
            [
                'name' => 'Admin',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('123'),
            ]);

       // User::factory()->create();

       // Employee::factory()->count()->create([
            //'name' => 'Employee test',
            //'email' => 'employee@example.com',
        //]);


       // Order::factory()->create([
            //'user_id' => 1, // Assuming a user with ID 1 exists
            //'total_amount' => 29.99,
           // 'order_status' => 'Processing',
       // ]);

        
    }
}
