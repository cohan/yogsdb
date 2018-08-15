<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->increments('id');

            $table->text('stars');
            $table->text('series');
            $table->text('not_stars');
            $table->text('not_series');

            $table->timestamps();
            $table->softDeletes();
        });
    }

}
