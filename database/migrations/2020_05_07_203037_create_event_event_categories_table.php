<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventEventCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_event_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_category_id')->index();
            $table->foreignId('event_id')->index();
            $table->timestamps();

            $table->index(['event_category_id', 'event_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_event_categories');
    }
}
