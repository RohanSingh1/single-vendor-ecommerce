<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentTypeToContactProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_product', function (Blueprint $table) {
            $table->unsignedInteger('payment_type_id')->nullable()->after('quantity');
            $table->foreign('payment_type_id')->references('id')
                ->on('payment_types')
                ->onDelete('cascade')->onUpdate('cascade');

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
            $table->dropColumn(['payment_type_id']);
        });
    }
}
