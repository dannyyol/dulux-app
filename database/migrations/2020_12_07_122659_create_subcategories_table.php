<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('language_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('category_id')->nullable();
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
        Schema::dropIfExists('subcategories');
    }
}
