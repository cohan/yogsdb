<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelSeriesPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_series', function (Blueprint $table) {
            $table->integer('channel_id')->unsigned()->index();
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
            $table->integer('series_id')->unsigned()->index();
            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
            $table->primary(['channel_id', 'series_id']);
        });
    }

}
