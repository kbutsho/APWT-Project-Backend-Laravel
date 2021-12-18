<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('category');
            $table->string('quantity');
            $table->string('price');
            $table->string('image');
            $table->string('productDetails');
            $table->string('sellerName');
            $table->string('sellerNumber');
            $table->integer('sellerId')->unsigned()->index();
            $table->timestamps();           
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('sellerId')->references('id')->on('sellers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
