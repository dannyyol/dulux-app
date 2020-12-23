<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVariationAddonsColsToOrderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->text('variations')->after('description')->nullable();
            $table->text('addons')->after('variations')->nullable();
            $table->decimal('variations_price', 11, 2)->after('addons')->default(0.00);
            $table->decimal('addons_price', 11, 2)->after('variations_price')->nullable(0.00);
            $table->decimal('product_price', 11, 2)->after('addons_price')->nullable(0.00);
            $table->decimal('total', 11, 2)->after('product_price')->nullable(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['variations', 'addons', 'variations_price', 'addons_price', 'product_price', 'total']);
        });
    }
}
