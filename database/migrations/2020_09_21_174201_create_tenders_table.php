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
			$table->string('address')->nullable();
			$table->unsignedSmallInteger('version')->nullable();
			$table->unsignedBigInteger('profile_id')->nullable();
			$table->string('wood')->nullable();
			$table->string('color')->nullable();
			$table->decimal('area')->nullable();
			$table->decimal('meters')->nullable();
			$table->decimal('total',8,2)->nullable();
			$table->decimal('cost',8,2)->nullable();
			$table->decimal('expenses',8,2)->nullable();
			$table->text('comments')->nullable();
			$table->unsignedSmallInteger('state')->nullable();

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
