<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_categories', function (Blueprint $table) {

            $table->increments("id");

            $table->integer('user_id')->unsigned();
            $table->integer('cat_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('cat_id')->references('id')->on('categories');


        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
