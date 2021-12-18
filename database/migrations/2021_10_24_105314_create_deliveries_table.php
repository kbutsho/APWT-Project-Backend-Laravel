<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Address');
            $table->string('customerName');
            $table->string('customerId');
            $table->string('productName');
            $table->string('productId');
            $table->string('s_ProviderName');
            $table->integer('serviceProviderId')->unsigned()->index(); 
            $table->string('comment');
            $table->string('status');
            $table->timestamps();
           
        });
        Schema::table('deliveries', function (Blueprint $table) {
            $table->foreign('serviceProviderId')->references('id')->on('service_providers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
