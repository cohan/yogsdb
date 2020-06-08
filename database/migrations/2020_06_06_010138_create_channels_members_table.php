<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelsMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels_members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('channel_id')
                ->references('id')
                ->on('channels');

            $table->unsignedBigInteger('member_id')
                ->references('id')
                ->on('members');

            $table->unique('channel_id', 'member_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channels_members');
    }
}
