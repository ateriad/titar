<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_id')->index();
            $table->string('key')->index();
            $table->string('value')->index();
            $table->timestamps();

            $table->index(['video_id', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_attributes');
    }
}
