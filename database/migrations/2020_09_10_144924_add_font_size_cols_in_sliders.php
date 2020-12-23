<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFontSizeColsInSliders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->tinyInteger('title_font_size')->default(60);
            $table->tinyInteger('text_font_size')->default(18);
            $table->tinyInteger('button_text_font_size')->default(14);
            $table->tinyInteger('button_text1_font_size')->default(14);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn(['title_font_size', 'text_font_size', 'button_text_font_size', 'button_text1_font_size']);
        });
    }
}
