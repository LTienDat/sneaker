<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupplierToNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->string('warehouse_id');
            $table->foreign('warehouse_id')->references('MaHD')->on('warehouses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            //
        });
    }
}
