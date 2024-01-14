<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAddcolamountAllotmentClassAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('allotment_class_accounts', function (Blueprint $table) {
            //
            $table->double('allotment_class_account_budget')->nullable()
                ->default(0)
                ->after('allotment_class_account');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('allotment_class_accounts', function (Blueprint $table) {
            //
        });
    }
}
