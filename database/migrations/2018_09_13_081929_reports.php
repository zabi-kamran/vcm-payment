<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Reports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	
	Schema::create('reports', function (Blueprint $table) {

           $table->increments("id");
          $table->string('data');
            $table->integer('issaved');
            $table->integer('issent');
            $table->string('sent_at')->nullable();
            $table->string('name')->nullable();
            $table->integer('user_id')->unsigned();



            $table->timestamps();

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
