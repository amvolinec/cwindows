<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_offer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_id')->nullable();
			$table->foreign('person_id')->references('id')->on('persons')->onDelete('set null');
;
			$table->unsignedBigInteger('offer_id')->nullable();
			$table->foreign('offer_id')->references('id')->on('offers')->onDelete('set null');
;
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
        Schema::dropIfExists('person_offer');
    }
}
