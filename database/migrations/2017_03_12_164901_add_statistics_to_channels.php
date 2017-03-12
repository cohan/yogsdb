<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatisticsToChannels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('channels', function (Blueprint $table) {
            $table->bigInteger('view_count')->nullable()->default(0);
            $table->bigInteger('comment_count')->nullable()->default(0);
            $table->bigInteger('subscriber_count')->nullable()->default(0);
            $table->bigInteger('video_count')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('channels', function (Blueprint $table) {
            $table->dropColumn('view_count');
            $table->dropColumn('comment_count');
            $table->dropColumn('subscriber_count');
            $table->dropColumn('video_count');
        });
    }
}
