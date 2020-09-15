<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('completed_at')->nullable();
			$table->unsignedTinyInteger('state_id')->nullable();
			$table->decimal('costs',9,2)->nullable();
			$table->decimal('income',9,2)->nullable();
			$table->unsignedTinyInteger('pay_id')->nullable();
			$table->boolean('warranty')->nullable();
			$table->text('notes')->nullable();
			$table->text('list_of_orders')->nullable();
			$table->string('executor')->nullable();
			$table->unsignedBigInteger('offer_id')->nullable();
			$table->foreign('offer_id')->references('id')->on('offers')->onDelete('set null');
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('set null');
			$table->unsignedBigInteger('user_id')->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('services');
    }
}
