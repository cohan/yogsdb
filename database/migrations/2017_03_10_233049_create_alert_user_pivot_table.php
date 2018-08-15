<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertUserPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alert_user', function (Blueprint $table) {
            $table->integer('alert_id')->unsigned()->index();
            $table->foreign('alert_id')->references('id')->on('alerts')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['alert_id', 'user_id']);
        });
    }

}
