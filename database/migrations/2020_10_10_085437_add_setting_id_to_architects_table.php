<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingIdToArchitectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architects', function (Blueprint $table) {
            $table->unsignedBigInteger('setting_id')->nullable();

            $table->foreign('setting_id')->on('settings')->references('id')
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
        Schema::table('architects', function (Blueprint $table) {
            $table->dropColumn('setting_id');
        });
    }
}
