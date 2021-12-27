<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelletUsageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pellet_usage', function (Blueprint $table) {
            $table->id();
            $table->timestamp('add_time');
            $table->integer('bag_amount');
            $table->bigInteger('producer_id', false, true);
            $table->foreign('producer_id')->references('id')->on('pellet_producer');
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
        Schema::dropIfExists('pellet_usage');
    }
}
