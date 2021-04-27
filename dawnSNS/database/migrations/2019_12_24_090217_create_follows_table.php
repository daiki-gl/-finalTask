<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->increments('id')->unsigned(false)->autoIncrement();
            $table->integer('follow_id');
            $table->integer('follower_id');
            $table->timestamp('created_at')->useCurrent()->nullable(false);
            $table->foreign('follow_id')->references('id')->on('users');
            $table->foreign('follower_id')->references('id')->on('users');
        });
    }
    
    // 下記でマイグレーションしなおし？
    // $table->foreign('follower_id')->references('user_id')->on('posts');
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
