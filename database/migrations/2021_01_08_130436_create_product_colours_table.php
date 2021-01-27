<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductColoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_colours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('language_id')->nullable();
            $table->integer('colour_category_id')->nullable();
            $table->string('colour_name')->nullable();
            $table->string('colour_code')->nullable();

            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->nullable();
            $table->integer('is_feature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_colours');
    }
}
