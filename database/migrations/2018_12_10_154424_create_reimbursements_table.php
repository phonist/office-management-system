<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Http\Str;
class CreateReimbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reimbursements', function (Blueprint $table) {
            $table->uuid('id');
            $table->date('date')->nullable();
            $table->uuid('department_id')->nullable();
            $table->uuid('employee_id');
            $table->float('amount',15,2)->nullable();
            $table->string('description')->nullable();
            $table->boolean('m_approved')->nullable();
            $table->string('m_comment')->nullable();
            $table->boolean('a_approved')->nullable();
            $table->string('a_comment')->nullable();
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
        Schema::dropIfExists('reimbursements');
    }
}
