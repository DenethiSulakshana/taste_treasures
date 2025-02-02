<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id(); // auto-incrementing ID
            $table->unsignedBigInteger('user_id');  // user_id for foreign key
            $table->unsignedBigInteger('food_id');  // food_id for foreign key
            $table->integer('quantity');  // quantity of the item
            $table->decimal('total_price', 8, 2);  // total price for the item
            $table->timestamps();  // created_at and updated_at timestamps

            // Defining foreign key relationships
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('food_id')->references('id')->on('food')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
