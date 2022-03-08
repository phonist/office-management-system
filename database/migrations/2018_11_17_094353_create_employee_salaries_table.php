<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Http\Str;
class CreateEmployeeSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('type')->nullable();
            $table->string('pay_grade')->nullable();
            $table->string('comment')->nullable();
            $table->float('basic_payment',15,2)->nullable();
            $table->float('car_allowance',15,2)->nullable();
            $table->float('medical_allowance',15,2)->nullable();
            $table->float('living_allowance',15,2)->nullable();
            $table->float('house_rent',15,2)->nullable();
            $table->float('gratuity',15,2)->nullable();
            $table->float('pension',15,2)->nullable();
            $table->float('insurance',15,2)->nullable();
            $table->float('total_deduction',15,2)->nullable();
            $table->float('total_payable',15,2)->nullable();
            $table->float('cost_to_company',15,2)->nullable();
            $table->uuid('employee_id');
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_salaries');
    }
}
