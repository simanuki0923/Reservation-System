<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('reservation_id')->nullable(); // Make this column nullable
        $table->unsignedBigInteger('restaurant_id');
        $table->tinyInteger('rating')->unsigned();
        $table->text('comment')->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('set null'); // Adjusted to set null if the referenced reservation is deleted
        $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
       });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
