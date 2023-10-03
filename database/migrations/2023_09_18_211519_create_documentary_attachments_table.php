<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentaryAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentary_attachments', function (Blueprint $table) {
            $table->id('documentary_attachment_id');

            $table->unsignedBigInteger('accounting_id');
            $table->foreign('accounting_id')->references('accounting_id')->on('accountings')
                    ->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('documentary_attachments');
    }
}
