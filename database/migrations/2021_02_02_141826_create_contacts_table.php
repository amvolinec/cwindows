<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('firm_id')->nullable();
            $table->unsignedBigInteger('contact_type_id')->nullable();
            $table->timestamps();

            $table->foreign('firm_id')
                ->references('id')
                ->on('contacts')
                ->onDelete('set null');

            $table->foreign('contact_type_id')
                ->references('id')
                ->on('contact_types')
                ->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
