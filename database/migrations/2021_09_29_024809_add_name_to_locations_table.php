<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameToLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('from_location');
            $table->dropColumn('to_location');
            $table->string('name')->after('id');
            $table->string('slug')->after('name')->unique();
            $table->unsignedInteger('province_id')->after('name');
            $table->unsignedInteger('district_id')->after('province_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('slug');
            $table->dropColumn('province_id');
            $table->dropColumn('district_id');
        });
    }
}
