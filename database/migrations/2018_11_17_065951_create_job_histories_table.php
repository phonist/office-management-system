<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Http\Str;
class CreateJobHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_histories', function (Blueprint $table) {
            $table->uuid('id');
            $table->date('effective_from')->nullable();
            $table->uuid('department_id')->nullable();
            $table->uuid('title_id')->nullable();
            $table->uuid('category_id')->nullable();
            $table->uuid('status_id')->nullable();
            $table->uuid('shift_id')->nullable();
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
        Schema::dropIfExists('job_histories');
    }
}
