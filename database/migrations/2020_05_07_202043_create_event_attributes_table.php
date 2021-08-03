<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->index();
            $table->string('key')->index();
            $table->string('value')->index();
            $table->timestamps();

            $table->index(['event_id', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_attributes');
    }
}
