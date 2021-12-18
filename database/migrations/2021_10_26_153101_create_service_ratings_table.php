<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('rating');
            $table->string('review');
            $table->integer('serviceProviderId')->unsigned()->index(); 
            $table->string('customerName'); 
            $table->string('s_ProviderName');    
            $table->integer('customerId')->unsigned()->index(); 
            $table->timestamps();
        });
        Schema::table('service_ratings', function (Blueprint $table) {
            $table->foreign('serviceProviderId')->references('id')->on('service_providers')->onDelete('cascade');
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
        Schema::dropIfExists('service_ratings');
    }
}
