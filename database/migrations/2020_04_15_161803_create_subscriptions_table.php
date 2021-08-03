<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->unsignedTinyInteger('type')->index();
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->index()->nullable();
            $table->unsignedBigInteger('price');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['start', 'end']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
