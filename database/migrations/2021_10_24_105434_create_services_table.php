<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('s_ProviderName');
            $table->string('productName');
            $table->string('Address');
            $table->string('status');
            $table->string('note');
            $table->timestamps();
            $table->integer('serviceProviderId')->unsigned()->index();
        });
        Schema::table('services', function (Blueprint $table) {
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
        Schema::dropIfExists('services');
    }
}
