<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('warehouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('site_id')->nullable()->default(null);
            $table->string('code')->nullable();
            $table->string('name');
            $table->timestamps();

            $table->foreign('site_id')->references('id')->on('sites')->onDelete('set null');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('generics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('manufacturers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->unsignedBigInteger('manufacturer_id')->nullable()->default(null);

            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('product_uoms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->unsignedBigInteger('category_id')->nullable()->default(null);
            $table->unsignedBigInteger('group_id')->nullable()->default(null);
            $table->unsignedBigInteger('brand_id')->nullable()->default(null);
            $table->unsignedBigInteger('generic_id')->nullable()->default(null);
            $table->unsignedBigInteger('model_id')->nullable()->default(null);
            $table->unsignedBigInteger('product_uom_id')->nullable()->default(null);
            $table->string('description')->nullable();
            $table->unsignedDecimal('price')->nullable()->default(0);
            $table->boolean('has_instances')->default(0);
            $table->boolean('has_lots')->default(0);
            $table->boolean('has_attributes')->default(0);
            $table->string('pack_size')->nullable();
            $table->unsignedDecimal('average_cost')->nullable()->default(0);
            $table->string('single_unit_product_code')->nullable();
            $table->string('dimension_group')->nullable();
            $table->string('lot_information')->nullable();
            $table->string('warranty_terms')->nullable();
            $table->boolean('is_active')->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('set null');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
            $table->foreign('generic_id')->references('id')->on('generics')->onDelete('set null');
            $table->foreign('model_id')->references('id')->on('models')->onDelete('set null');
            $table->foreign('product_uom_id')->references('id')->on('product_uoms')->onDelete('set null');
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('product_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->nullable()->default(null);
            $table->unsignedBigInteger('attribute_id')->nullable()->default(null);
            $table->string('value');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id')->nullable()->default(null);
            $table->datetime('purchase_date')->nullable();
            $table->unsignedDecimal('total_amount', 11, 2);
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
        });

        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->nullable()->default(null);
            $table->unsignedBigInteger('product_id')->nullable()->default(null);
            $table->unsignedDecimal('price', 11, 2);
            $table->unsignedDecimal('quantity', 11, 3);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
        });

        Schema::create('prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('date_from')->nullable();
            $table->unsignedDecimal('price', 11, 2);
            $table->unsignedBigInteger('product_id')->nullable()->default(null);
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attributes');
        Schema::dropIfExists('products');
        Schema::dropIfExists('prices');
        Schema::dropIfExists('items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('models');
        Schema::dropIfExists('generics');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('manufacturers');
        Schema::dropIfExists('product_uoms');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('warehouses');
        Schema::dropIfExists('sites');
    }
}
