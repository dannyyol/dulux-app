<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropExtraColsFromBasicExtendeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('basic_extendeds', function (Blueprint $table) {
            $table->dropColumn(['pricing_title', 'pricing_subtitle', 'pricing_section','hero_overlay_color','hero_overlay_opacity','statistics_overlay_color','statistics_overlay_opacity','team_overlay_color','team_overlay_opacity','breadcrumb_overlay_color','breadcrumb_overlay_opacity','popular_tags','instagram_section_title','instagram_section_subtitle']);
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
            //
        });
    }
}
