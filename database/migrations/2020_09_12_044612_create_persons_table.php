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
        Schema::create('person_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50)->nullable();
            $table->string('slug',50)->nullable();
            $table->string('description',255)->nullable();
            $table->timestamps();
        });

        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50)->nullable();
			$table->string('email',100)->nullable();
			$table->string('phone',15)->nullable();
			$table->string('notes',2000)->nullable();
			$table->text('parameters')->nullable();

			$table->unsignedBigInteger('company_id')->nullable();
			$table->unsignedBigInteger('person_type_id')->nullable();
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
			$table->foreign('person_type_id')->references('id')->on('person_types')->onDelete('set null');
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
        Schema::dropIfExists('person_types');
    }
}
