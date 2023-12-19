<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcurementDocumentaryAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_documentary_attachments', function (Blueprint $table) {
            $table->id('procurement_documentary_attachment_id');

            $table->unsignedBigInteger('procurement_id');
            $table->foreign('procurement_id')->references('procurement_id')->on('procurements')
                    ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('documentary_attachment_id');

            $table->string('documentary_attachment')->nullable();
            $table->string('doc_attachment')->nullable();

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
        Schema::dropIfExists('procurement_documentary_attachments');
    }
}
