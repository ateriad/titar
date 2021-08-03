<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageImageCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_image_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_category_id')->index();
            $table->foreignId('image_id')->index();
            $table->timestamps();

            $table->index(['image_category_id', 'image_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_image_category');
    }
}
