<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->index();
            $table->string('ip');
            $table->unsignedSmallInteger('source')->nullable();
            $table->foreignId('user_id')->index();
            $table->foreignId('advertisement_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_visits');
    }
}
