<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('manager_id')->nullable();
			$table->foreign('manager_id')->references('id')->on('users')->onDelete('set null');
;
			$table->string('delivery_address')->nullable()->default('');
			$table->unsignedSmallInteger('version')->nullable();
			$table->unsignedBigInteger('profile_id')->nullable();
			$table->foreign('profile_id')->references('id')->on('profiles')->onDelete('set null');
;
			$table->string('materials')->nullable();
			$table->string('colors')->nullable();
			$table->string('squaring')->nullable();
			$table->decimal('meters')->nullable();
			$table->decimal('total_with_vat',11,2)->nullable();
			$table->decimal('cost',11,2)->nullable();
			$table->decimal('expenses',11,2)->nullable();
			$table->text('comment')->nullable();
			$table->unsignedSmallInteger('state')->nullable();
			$table->unsignedBigInteger('offer_id')->nullable();
			$table->foreign('offer_id')->references('id')->on('offers')->onDelete('set null');
;
			$table->decimal('total',11,2)->nullable();

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
        Schema::dropIfExists('tenders');
    }
}
