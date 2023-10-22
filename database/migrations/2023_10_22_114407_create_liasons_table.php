<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liasons', function (Blueprint $table) {
            $table->id('liason_id');
            $table->string('lname')->nullable();
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('sex')->nullable();
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
        Schema::dropIfExists('liasons');
    }
}
