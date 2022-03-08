<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Http\Str;
class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            //
            $table->uuid('id')->primary();
            $table->string('invoice_number');
            $table->uuid('client_id');
            $table->date('invoice_date')->nullable();
            $table->date('due_date')->nullable();
            $table->float('total')->nullabl();
            $table->float('g_total')->nullable();
            $table->float('tax')->nullable();
            $table->float('discount')->nullable();
            $table->float('paid')->nullable();
            $table->float('balance')->nullable();
            $table->float('receive_amt')->nullable();
            $table->float('amt_due')->nullable();
            $table->string('tracking_no')->nullable();
            $table->string('delivery_person')->nullable();
            $table->string('status')->nullable();
            $table->string('order_note')->nullable();
            $table->string('order_activities')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
