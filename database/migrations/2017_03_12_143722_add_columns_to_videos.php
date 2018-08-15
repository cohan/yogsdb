<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->integer('duration')->default(0)->nullable();
            $table->bigInteger('view_count')->default(0)->nullable();
            $table->bigInteger('like_count')->default(0)->nullable();
            $table->bigInteger('dislike_count')->default(0)->nullable();
            $table->bigInteger('comment_count')->default(0)->nullable();
        });
    }

}
