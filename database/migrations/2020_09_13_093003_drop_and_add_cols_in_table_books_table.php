<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAndAddColsInTableBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('table_books', function (Blueprint $table) {
            $table->dropColumn(['phone', 'date', 'time', 'person']);
            $table->text('fields')->after('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_books', function (Blueprint $table) {
            $table->dropColumn('fields');
        });
    }
}
