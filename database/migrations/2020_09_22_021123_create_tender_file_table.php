<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_file', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('tender_id')->nullable();
            $table->unsignedBigInteger('file_id')->nullable();

            $table->foreign('file_id')->references('id')->on('files')->onDelete('set null');
            $table->foreign('tender_id')->references('id')->on('tenders')->onDelete('set null');

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
        Schema::dropIfExists('tender_file');
    }
}
