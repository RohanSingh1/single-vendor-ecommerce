<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('full_names')->nullable();
            $table->string('payment_option')->default('cash_on_delivery');
            $table->double('shipping_price',10,2)->default(0);
            $table->double('coupon_discounts',10,2)->default(0);
            $table->double('coupon_discounts_total',10,2)->default(0);
            $table->double('total_discounts',10,2)->default(0);
            $table->double('sub_totals',10,2)->default(0);
            $table->double('grand_totals',10,2)->default(0);
            $table->enum('status', ['delivered', 'pending','cancelled']);
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
        Schema::dropIfExists('orders');
    }
}
