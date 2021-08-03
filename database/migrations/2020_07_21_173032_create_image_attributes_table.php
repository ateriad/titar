<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_id')->index();
            $table->string('key')->index();
            $table->string('value')->index();
            $table->timestamps();

            $table->index(['image_id', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_attributes');
    }
}
