<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('user_id');
            $table->string('name');
            $table->longText('description');
            $table->longText('long_description');
            $table->string('category');
            $table->string('developer');
            $table->string('publisher');
            $table->string('price');
            $table->string('cover');
            $table->string('trailer');
            $table->boolean('for_adult');
            $table->boolean('deleted_admin')->default(FALSE);
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
        Schema::dropIfExists('games');
    }
}
