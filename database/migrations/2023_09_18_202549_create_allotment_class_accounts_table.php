<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllotmentClassAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allotment_class_accounts', function (Blueprint $table) {
            $table->id('allotment_class_account_id');

            $table->unsignedBigInteger('allotment_class_id');
            $table->foreign('allotment_class_id')->references('allotment_class_id')->on('allotment_classes')
                    ->onDelete('cascade')->onUpdate('cascade');

                    
            $table->string('allotment_class_account_code')->nullable();
            $table->string('allotment_class_account')->nullable();

            $table->double('allotment_class_account_budget')->nullable()
                ->default(0);
            $table->double('allotment_class_account_balance')->nullable()
                ->default(0);
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
        Schema::dropIfExists('allotment_class_accounts');
    }
}
