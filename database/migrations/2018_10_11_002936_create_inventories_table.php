<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('model_no')->nullable();
            $table->string('in_house')->nullable();
            $table->string('image')->nullable();
            $table->float('s_price')->nullable();
            $table->string('s_information')->nullable();
            $table->float('p_price')->nullable();
            $table->string('p_information')->nullable();
            $table->string('quantity')->nullable();
            $table->string('type')->nullable();
            $table->uuid('category_id')->nullable();
            $table->uuid('tax_id')->nullable();
            $table->uuid('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
