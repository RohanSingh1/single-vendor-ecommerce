<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityToContactProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_product', function (Blueprint $table) {
            $table->double('quantity')->nullable()->after('product_id');
            $table->double('unit_price')->nullable()->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_products', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'unit_price']);
        });
    }
}
