<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrolleesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('second_name');
            $table->string('sex');
            $table->string('group');
            $table->string('email');
            $table->integer('points');
            $table->timestamp('dob')->nullable();
            $table->enum('location', ['Местный', 'Иногородний']);
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
        Schema::dropIfExists('enrollees');
    }
}
