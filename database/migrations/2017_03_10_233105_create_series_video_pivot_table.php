<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeriesVideoPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series_video', function (Blueprint $table) {
            $table->integer('series_id')->unsigned()->index();
            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
            $table->integer('video_id')->unsigned()->index();
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
            $table->primary(['series_id', 'video_id']);
        });
    }

}
