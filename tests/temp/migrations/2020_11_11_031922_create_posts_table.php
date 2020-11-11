<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts',function(Blueprint $table){
            $table->id();
            $table->enum('active',[1,2])->comment('1 for active,2 for inactive')->default('1')->nullable();
            $table->string('title')->comment('titleComment')->nullable();
            $table->text('body');
            $table->text('image');
            $table->integer('visitors')->nullable();
            $table->integer('user_id')->unsigned();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }

}