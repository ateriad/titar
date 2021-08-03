<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoVideoCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_video_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_category_id')->index();
            $table->foreignId('video_id')->index();
            $table->timestamps();

            $table->index(['video_category_id', 'video_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_video_category');
    }
}
