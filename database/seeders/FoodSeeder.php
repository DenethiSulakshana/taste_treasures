<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    public function run()
    {
        Food::create([
            'name' => 'Potato Chips',
            'category' => 'Snacks',
            'description' => 'Delisious',
            'image_path' => 'images/chips.jpg', 
            'price' => 2500.00,
            'stock_level' => 50,
        ]);
        
    }
}

