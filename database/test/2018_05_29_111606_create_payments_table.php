<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname',50);
            $table->string('lname',50);
            $table->date('dob');
            $table->tinyInteger('gender')->default(0)->comment('0 Male, 1 Female');
            $table->string('mother_name',50);
            $table->integer('gsm_net');
            $table->string('gsm_no',15);
            $table->string('state',30);
            $table->integer('lga');
            $table->integer('ward');
            $table->integer('category');
            $table->decimal('pay_amt',10,2)->default(0);
            $table->decimal('other',10,2)->default(0);
            $table->decimal('total',10,2)->default(0);
            $table->tinyInteger('status')->default(0)->comment('0 active, 1 deactive');
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
        Schema::dropIfExists('payments');
    }
}
