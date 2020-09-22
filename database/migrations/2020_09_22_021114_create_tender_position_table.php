<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderPositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_position', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tender_id')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();

            $table->foreign('tender_id')->references('id')->on('tenders')->onDelete('set null');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('set null');

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
        Schema::dropIfExists('tender_position');
    }
}
