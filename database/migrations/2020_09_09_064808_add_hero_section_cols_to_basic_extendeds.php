<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHeroSectionColsToBasicExtendeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('basic_extendeds', function (Blueprint $table) {
            $table->string('hero_bg', 50)->nullable();
            $table->string('hero_section_bold_text', 255)->nullable();
            $table->tinyInteger('hero_section_bold_text_font_size')->default(60);
            $table->string('hero_section_bold_text_color', 20)->default('FFFFFF');
            $table->string('hero_section_text', 255)->nullable();
            $table->tinyInteger('hero_section_text_font_size')->default(18);
            $table->string('hero_section_text_color', 20)->default('FFFFFF');
            $table->string('hero_section_button_text', 255)->nullable();
            $table->tinyInteger('hero_section_button_text_font_size')->default(14);
            $table->string('hero_section_button_color', 20)->default('FFFFFF');
            $table->text('hero_section_button_url')->nullable();
            $table->string('hero_section_button2_text', 255)->nullable();
            $table->tinyInteger('hero_section_button2_text_font_size')->default(14);
            $table->text('hero_section_button2_url')->nullable();
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
            $table->dropColumn(['hero_section_bold_text','hero_section_bold_text_font_size','hero_section_bold_text_color','hero_section_text','hero_section_text_font_size','hero_section_text_color','hero_section_button_text','hero_section_button_text_font_size','hero_section_button_color','hero_section_button_url','hero_section_button2_text','hero_section_button2_text_font_size','hero_section_button2_url']);
        });
    }
}
