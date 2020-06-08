<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('source')->default('youtube');
            $table->string('source_id');
            $table->unique('source', 'source_id');

            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->unsignedInteger('duration')->default(0);

            $table->unsignedBigInteger('view_count')->default(0);
            $table->unsignedBigInteger('like_count')->default(0);
            $table->unsignedBigInteger('dislike_count')->default(0);
            $table->unsignedBigInteger('comment_count')->default(0);

            $table->string('game')->default('Unknown');
            $table->json('tags')->nullable();
            $table->string('image')->nullable();


            $table->unsignedBigInteger('channel_id')
                ->references('id')
                ->on('channels')
                ->onDelete('cascade')
                ->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
