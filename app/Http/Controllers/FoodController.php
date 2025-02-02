<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::all();

        $orderCount = Order::where('user_id', Auth::id())->count(); 
        return view('users.foods.index', compact('foods','orderCount'));
    }

    public function adminIndex()
    {
        $foods = Food::all();
        return view('admin.foods.index', compact('foods'));
    }

    public function create()
    {
        return view('admin.foods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock_level' => 'required|integer',
            'image' => 'required|image'
        ]);
        $path = $request->file('image')->store('images', 'public');


        Food::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'stock_level' => $request->stock_level,
            'image_path' => $path
        ]);

        return redirect()->route('admin.foods.index')->with('success', 'Food added successfully!');
    }

    /**
    * Show the form for editing the specified food$food.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit($id)
    {
        // Find the food$food by ID
        $food = Food::findOrFail($id);
 
        // Pass the food$food to the edit view
        return view('admin.foods.edit', compact('foods'));
    }
 
    /**
    * Update the specified food$food in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock_level' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
 
        // Find the food$food
        $food = Food::findOrFail($id);
 
        // Update food$food fields
        $food->name = $request->input('name');
        $food->category = $request->input('category');
        $food->description = $request->input('description');
        $food->price = $request->input('price');
        $food->stock_level = $request->input('stock_level');
 
        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $food->image_path = $imagePath;
        }
 
        // Save the updated food$food
        $food->save();
 
        // Redirect back to the products index with a success message
        return redirect()->route('admin.foods.index')->with('success', 'Food updated successfully.');
    }

    public function destroy($id)
    {
        // Find the food$food by ID
        $food = Food::findOrFail($id);

        // Delete the food$food
        $food->delete();

        // Redirect to the products index with a success message
        return redirect()->route('admin.foods.index')->with('success', 'Food deleted successfully.');
    }


    public function show($id)
    {
        $food = Food::findOrFail($id);

        // Get food$food reviews and calculate average rating
        $reviews = $food->reviews()->with('user')->latest()->get();
        $averageRating = $food->reviews()->avg('stars') ?? 0;

        return view('users.foods.show', compact('foods', 'reviews', 'averageRating'));
    }

    

}

