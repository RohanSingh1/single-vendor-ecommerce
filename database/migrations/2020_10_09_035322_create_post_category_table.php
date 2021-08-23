<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->timestamps();
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->unsignedInteger('post_category_id')->nullable()->after('post_type_id');
//            $table->foreign('post_category_id')->references('id')->on('post_category')->onDelete('cascade')->onUpdate('cascade');
        });
         $data = array(
            array('id' => 1, 'title' => "Faqs", 'slug' => 'faqs')
        );
        \Illuminate\Support\Facades\DB::table('post_category')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_category');
    }
}
