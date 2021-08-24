<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('user_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
	        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        $data = [
            [
                'role_id'=>"1",
                'user_id'=>"1"
            ],
            [
                'role_id'=>"2",
                'user_id'=>"2"
            ],
            [
                'role_id'=>"3",
                'user_id'=>"3"
            ],
            [
                'role_id'=>"3",
                'user_id'=>"1"
            ]

            ];
        \DB::table('role_user')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
