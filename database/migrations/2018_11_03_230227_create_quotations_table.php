<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Http\Str;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('client_id');
            $table->date('estimate_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->float('total')->nullable();
            $table->float('g_total')->nullable();
            $table->float('tax')->nullable();
            $table->float('discount')->nullable();
            $table->string('status')->nullable();
            $table->string('order_activities')->nullable();
            $table->string('order_note')->nullable();
            $table->string('invoice_number');
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotations');
    }
}
