<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            
            $table->string('ref_id')->unique();
            $table->string('username')->unique();
            $table->string('lname');
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('suffix', 20)->nullable();
            $table->string('sex', 20)->nullable();
            $table->string('civil_status', 100)->nullable();

            $table->string('office_id')->nullable();
            $table->string('contact_no')->nullable();
            $table->date('birthdate')->nullable();

            $table->integer('program_id')->default(0);

            $table->string('role')->nullable();
            $table->tinyInteger('is_activated')->default(0);

            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('barangay')->nullable();
            $table->string('street')->nullable();

            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
