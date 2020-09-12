<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50)->nullable();
			$table->string('email',100)->nullable();
			$table->string('phone',15)->nullable();
			$table->unsignedBigInteger('company_id')->nullable();
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
;
			$table->string('address',255)->nullable();

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
        Schema::dropIfExists('persons');
    }
}
