<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id('id');
            $table->uuid('warehouse_id');
            $table->foreign('warehouse_id')->references('warehouse_id')->on('whs_detail')->onDelete('restrict')->onUpdate('cascade');
            $table->string('product_code', 50);
            $table->foreign('product_code')->references('product_code')->on('products')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('stock');
            $table->string('location', 50)->nullable();
            $table->date('entry_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouses');
    }
};
