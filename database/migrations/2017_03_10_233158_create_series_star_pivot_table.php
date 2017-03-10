<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeriesStarPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series_star', function (Blueprint $table) {
            $table->integer('series_id')->unsigned()->index();
            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
            $table->integer('star_id')->unsigned()->index();
            $table->foreign('star_id')->references('id')->on('stars')->onDelete('cascade');
            $table->primary(['series_id', 'star_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('series_star');
    }
}
