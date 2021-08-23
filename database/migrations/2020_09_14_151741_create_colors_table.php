<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('value');
//            $table->timestamps();
        });
        $colors = array(
            array('id' => 1, 'name' => "Yellow", 'value' => 'yellow'),
            array('id' => 2, 'name' => "gray", 'value' => 'gray'),
            array('id' => 3, 'name' => "green", 'value' => 'green'),
            array('id' => 4, 'name' => "orange", 'value' => 'orange'),
            array('id' => 5, 'name' => "blue", 'value' => 'blue'),
            array('id' => 6, 'name' => "white", 'value' => 'white'),
            array('id' => 7, 'name' => "pink", 'value' => 'pink'),
            array('id' => 8, 'name' => "red", 'value' => 'red'),
            array('id' => 9, 'name' => "black", 'value' => 'black'),
            array('id' => 10, 'name' => "brown", 'value' => 'brown'),
        );
        \Illuminate\Support\Facades\DB::table('colors')->insert($colors);
         Schema::create('category_color', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('category')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['category_id','color_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_color');
        Schema::dropIfExists('colors');
    }
}
