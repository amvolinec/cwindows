<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('offer_id');
            $table->date('signed_at')->nullable();
            $table->date('planed_at')->nullable();
            $table->date('finished_at')->nullable();
            $table->date('warranted_at')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->string('address')->nullable();
            $table->decimal('amount',11, 2)->default(0);
            $table->decimal('payments',11, 2)->default(0);
            $table->unsignedBigInteger('maintenance_id')->nullable();
            $table->decimal('expenses',11, 2)->default(0);
            $table->decimal('margin',11, 2)->default(0);
            $table->unsignedBigInteger('period_id')->nullable();
            $table->date('production_start')->nullable();
            $table->date('production_end')->nullable();
            $table->date('installation_start')->nullable();
            $table->date('installation_end')->nullable();
            $table->text('installation_note')->nullable();

            $table->timestamps();

            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('set null');

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('set null');

            $table->foreign('manager_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('maintenance_id')
                ->references('id')
                ->on('maintenances')
                ->onDelete('set null');

            $table->foreign('offer_id')
                ->references('id')
                ->on('offers')
                ->onDelete('cascade');
        });

        Schema::create('production_numbers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('contract_id')->nullable();
            $table->timestamps();

            $table->foreign('contract_id')
                ->references('id')
                ->on('contracts')
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
        Schema::dropIfExists('contracts');
        Schema::dropIfExists('periods');
        Schema::dropIfExists('production_numbers');
    }
}
