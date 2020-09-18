<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount',9,2)->nullable();
			$table->string('number')->nullable();
			$table->date('date')->nullable();
			$table->unsignedBigInteger('state_id')->nullable();
			$table->unsignedBigInteger('transaction_type_id')->nullable();
			$table->foreign('transaction_type_id')->references('id')->on('transaction_types')->onDelete('set null');

            $table->unsignedBigInteger('offer_id')->nullable();
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('set null');

			$table->text('info')->nullable();
			$table->text('details')->nullable();

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
        Schema::dropIfExists('transactions');
    }
}
