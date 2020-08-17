<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('company_id')->nullable()->index();
			$table->unsignedBigInteger('client_id')->nullable()->index();
			$table->unsignedBigInteger('architect_id')->nullable()->index();
			$table->date('enquiry_date')->nullable();
			$table->date('planed_date')->nullable();
			$table->string('number')->nullable();
			$table->string('order_number')->nullable();
			$table->string('title')->nullable();
			$table->string('pv')->nullable();
			$table->string('area')->nullable();
			$table->integer('positions')->nullable();
			$table->string('profile')->nullable();
			$table->unsignedSmallInteger('state_id')->nullable()->index();
			$table->string('state_comment')->nullable();
			$table->string('info')->nullable();
			$table->string('pipeline')->nullable();
			$table->string('enquiry_channel')->nullable();
			$table->string('klaes')->nullable();
			$table->date('contract_date')->nullable();
			$table->string('contract_nr')->nullable();
			$table->date('price_1_date')->nullable();
			$table->decimal('price_1', 11, 2)->nullable();
			$table->date('price_2_date')->nullable();
			$table->decimal('price_2', 11, 2)->nullable();
			$table->date('price_3_date')->nullable();
			$table->decimal('price_3', 11, 2)->nullable();
			$table->decimal('total',11, 2)->default(0);
			$table->decimal('total_with_vat', 11, 2)->default(0);
			$table->decimal('balance', 11, 2)->default(0);
			$table->string('other_services')->nullable();
			$table->decimal('sales_profit', 11, 2)->default(0);
            $table->decimal('planned_amount_percents',11,2)->default(0);
			$table->decimal('project_amount', 11, 2)->default(0);
			$table->decimal('project_amount_with_vat', 11, 2)->default(0);
            $table->unsignedSmallInteger('user_id')->nullable()->index();
            $table->string('delivery_address')->nullable();
            $table->date('delivery_date')->nullable();
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
        Schema::dropIfExists('offers');
    }
}
