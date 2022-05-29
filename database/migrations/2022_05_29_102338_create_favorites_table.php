<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->foreignId('product_id');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
