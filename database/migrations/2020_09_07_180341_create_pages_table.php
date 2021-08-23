<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
        });
        $post_modules = [
            ['type'=>'Page'],
            ['type'=>'Custom Link'],
            ['type'=>'Module Item'],
        ];
        \Illuminate\Support\Facades\DB::table('post_types')->insert($post_modules);

        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('post_title');
            $table->string('url');
            $table->string('slug')->nullable();
            $table->mediumText('summary')->nullable();
            $table->longText('top_content')->nullable();
            $table->longText('bottom_content')->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('published')->default(0);
            $table->unsignedInteger('post_type_id');
            $table->foreign('post_type_id')->references('id')->on('post_types')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
        Schema::dropIfExists('post_types');
    }
}
