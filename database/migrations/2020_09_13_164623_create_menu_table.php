<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->boolean('is_active')->default(1);
            $table->boolean('is_selected')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        $menus = [
            [
                'title' => 'pre nav slider',
                'slug' => 'pre-nav',
                'is_active' => '1',
                'is_selected' => '0',
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'Main Menu',
                'slug' => 'main-menu',
                'is_active' => '1',
                'is_selected' => '1',
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => '1st footer menu',
                'slug' => 'first-footer',
                'is_active' => '1',
                'is_selected' => '0',
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => '2nd footer menu',
                'slug' => 'second-footer',
                'is_active' => '1',
                'is_selected' => '0',
                'created_at' => \Carbon\Carbon::now(),
            ],
        ];
        \Illuminate\Support\Facades\DB::table('menus')->insert($menus);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
