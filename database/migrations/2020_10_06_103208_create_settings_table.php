<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
			$table->string('code')->nullable();
			$table->string('vat_code')->nullable();
			$table->string('address')->nullable();
			$table->string('phone')->nullable();
			$table->string('account')->nullable();
			$table->string('email')->nullable();
			$table->string('web')->nullable();
			$table->string('file_name')->nullable();
			$table->string('file_uri')->nullable();
			$table->unsignedBigInteger('currency_id')->nullable();
			$table->foreign('currency_id')->references('id')->on('currencies')->onDelete('set null');

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
        Schema::dropIfExists('settings');
    }
}
