<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFontSizeColsTypeSliders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->integer('title_font_size')->default(60)->change();
            $table->integer('text_font_size')->default(18)->change();
            $table->integer('button_text_font_size')->default(14)->change();
            $table->integer('button_text1_font_size')->default(14)->change();
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
            $table->tinyInteger('title_font_size')->default(60)->change();
            $table->tinyInteger('text_font_size')->default(18)->change();
            $table->tinyInteger('button_text_font_size')->default(14)->change();
            $table->tinyInteger('button_text1_font_size')->default(14)->change();
        });
    }
}
