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
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_uri')->nullable();
            $table->timestamps();
        });

        Schema::create('colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_uri')->nullable();
            $table->timestamps();
        });

        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('company_id')->nullable()->index();
			$table->unsignedBigInteger('client_id')->nullable()->index();
			$table->unsignedBigInteger('architect_id')->nullable()->index();
			$table->date('inquiry_date')->nullable();
			$table->date('planed_date')->nullable();
			$table->string('number')->nullable();
			$table->string('order_number')->nullable();
			$table->string('title')->nullable();
			$table->string('pv')->nullable();
			$table->unsignedSmallInteger('state_id')->nullable()->index();
			$table->string('info')->nullable();
			$table->string('pipeline')->nullable();
			$table->string('enquiry_channel')->nullable();
			$table->string('klaes')->nullable();
			$table->date('contract_date')->nullable();
			$table->string('contract_nr')->nullable();
			$table->decimal('cost',11, 2)->default(0);
			$table->decimal('total',11, 2)->default(0);
			$table->decimal('total_with_vat', 11, 2)->default(0);
            $table->decimal('expenses', 11, 2)->default(0);
			$table->decimal('sales_profit', 11, 2)->default(0);
            $table->decimal('balance', 11, 2)->default(0);
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('delivery_address')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->unsignedTinyInteger('received_id')->default(1);
            $table->boolean('private')->default(0);
            $table->string('description', 2000)->nullable();
            $table->unsignedTinyInteger('type_id')->default(1);
            $table->unsignedTinyInteger('profile_id')->default(1);
            $table->unsignedBigInteger('maintenance_id')->nullable();
            $table->string('partner')->nullable();
            $table->unsignedSmallInteger('chance')->default(100);
            $table->unsignedBigInteger('editor_id')->nullable()->index();
            $table->unsignedBigInteger('material_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->string('materials')->nullable();
            $table->string('squaring')->nullable();
            $table->string('colors')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('set null');

            $table->foreign('manager_id')->references('id')->on('users')
                ->onDelete('set null');

            $table->foreign('editor_id')->references('id')->on('users')
                ->onDelete('set null');

            $table->foreign('material_id')->references('id')->on('materials')
                ->onDelete('set null');

            $table->foreign('color_id')->references('id')->on('colors')
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
        Schema::dropIfExists('offers');
        Schema::dropIfExists('materials');
        Schema::dropIfExists('colors');
    }
}
