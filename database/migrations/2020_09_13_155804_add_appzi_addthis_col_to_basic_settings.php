<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAppziAddthisColToBasicSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('basic_settings', function (Blueprint $table) {
            $table->tinyInteger('is_appzi')->default(0);
            $table->text('appzi_script')->nullable();
            $table->tinyInteger('is_addthis')->default(0);
            $table->text('addthis_script')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('basic_settings', function (Blueprint $table) {
            $table->dropColumn(['is_appzi', 'appzi_script', 'is_addthis', 'addthis_script']);
        });
    }
}
