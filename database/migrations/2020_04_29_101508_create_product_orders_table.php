<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('billing_country')->nullable();
            $table->string('billing_fname')->nullable();
            $table->string('billing_lname')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('billing_number')->nullable();
    
            $table->string('shpping_country')->nullable();
            $table->string('shpping_fname')->nullable();
            $table->string('shpping_lname')->nullable();
            $table->string('shpping_address')->nullable();
            $table->string('shpping_city')->nullable();
            $table->string('shpping_email')->nullable();
            $table->string('shpping_number')->nullable();
  

            $table->decimal('total', 11, 2)->nullable();
            $table->string('method')->nullable();
            $table->string('currency_code')->nullable();
            $table->string('order_number')->nullable();
            $table->decimal('shipping_charge', 11, 2)->nullable();
            $table->string('payment_status')->nullable();
            $table->string('order_status')->default('pending');
            $table->string('txnid')->nullable()->nullable();
            $table->string('charge_id')->nullable();
            $table->string('invoice_number')->nullable();
     
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
        Schema::dropIfExists('product_orders');
    }
}
