<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('user_id');
            $table->string('receipt_id', 500);
            $table->string('card_name');
            $table->string('card_number');
            $table->string('expired_month');
            $table->string('expired_year');
            $table->string('cvc');
            $table->string('country');
            $table->string('zip');
            $table->bigInteger('total');
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
        Schema::dropIfExists('transactions');
    }
}
