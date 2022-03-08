<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Http\Str;

class CreatePurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('invoice_number');
            $table->uuid('vendor_id');
            $table->string('b_reference')->nullable();
            $table->string('status')->nullable();
            $table->string('note')->nullable();
            $table->float('total')->nullable();
            $table->float('discount')->nullable();
            $table->float('tax')->nullable();
            $table->float('transport')->nullable();
            $table->float('g_total')->nullable();
            $table->float('paid')->nullable();
            $table->float('balance')->nullable();
            $table->timestamps();
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
