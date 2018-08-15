<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelStarPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_star', function (Blueprint $table) {
            $table->integer('channel_id')->unsigned()->index();
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
            $table->integer('star_id')->unsigned()->index();
            $table->foreign('star_id')->references('id')->on('stars')->onDelete('cascade');
            $table->primary(['channel_id', 'star_id']);
        });
    }

}
