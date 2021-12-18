<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('rating');
            $table->string('review');
            $table->integer('productId')->unsigned()->index(); 
            $table->string('customerName'); 
            $table->string('productName');   
            $table->integer('customerId')->unsigned()->index();  
            $table->timestamps(); 
        });
        Schema::table('product_ratings', function (Blueprint $table) {
            $table->foreign('productId')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('customerId')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_ratings');
    }
}
