<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeHeroTextsFontSizeInBasicExtendeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('basic_extendeds', function (Blueprint $table) {
            $table->integer('hero_section_bold_text_font_size')->default(60)->change();
            $table->integer('hero_section_text_font_size')->default(18)->change();
            $table->integer('hero_section_button_text_font_size')->default(14)->change();
            $table->integer('hero_section_button2_text_font_size')->default(14)->change();
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
            $table->tinyInteger('hero_section_bold_text_font_size')->default(60)->change();
            $table->tinyInteger('hero_section_text_font_size')->default(18)->change();
            $table->tinyInteger('hero_section_button_text_font_size')->default(14)->change();
            $table->tinyInteger('hero_section_button2_text_font_size')->default(14)->change();
        });
    }
}
