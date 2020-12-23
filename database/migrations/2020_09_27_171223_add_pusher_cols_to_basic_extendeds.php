<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPusherColsToBasicExtendeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('basic_extendeds', function (Blueprint $table) {
            $table->string('pusher_app_id', 15)->nullable();
            $table->string('pusher_app_key', 30)->nullable();
            $table->string('pusher_app_secret', 30)->nullable();
            $table->string('pusher_app_cluster', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('basic_extendeds', function (Blueprint $table) {
            $table->dropColumn(['pusher_app_id','pusher_app_key','pusher_app_secret','pusher_app_cluster']);
        });
    }
}
