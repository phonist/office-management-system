<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Http\Str;

class CreateSaleProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('inventory_id')->nullable();
            $table->string('description')->nullable();
            $table->string('quantity')->nullable();
            $table->string('rate')->nullable();
            $table->string('amount')->nullable();
            $table->uuid('invoice_id')->nullable();
            $table->foreign('invoice_id')->references('id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('sale_products');
    }
}
