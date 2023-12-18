<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetingDocumentaryAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgeting_documentary_attachments', function (Blueprint $table) {
            $table->id('budgeting_documentary_attachment_id');

            $table->unsignedBigInteger('budgeting_id');
            $table->foreign('budgeting_id')->references('budgeting_id')->on('budgetings')
                    ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('documentary_attachment_id');
//            $table->foreign('documentary_attachment_id')
//                ->references('documentary_attachment_id')
//                ->on('documentary_attachments')
//                ->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('budgeting_documentary_attachments');
    }
}
