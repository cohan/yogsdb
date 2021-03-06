<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChannelIdToVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->integer('channel_id')->nullable();
        });
    }

}
