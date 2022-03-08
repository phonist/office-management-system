<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Http\Str;
class CreatePurchaseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('inventory_id')->nullable();
            $table->string('description')->nullable();
            $table->string('quantity')->nullable();
            $table->string('rate')->nullable();
            $table->string('amount')->nullable();
            $table->integer('receive')->nullable();
            $table->integer('return')->nullable();
            $table->string('receiver')->nullable();
            $table->uuid('purchase_id')->nullable();
            $table->timestamps();
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_products');
    }
}
