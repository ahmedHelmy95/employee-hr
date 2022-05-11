<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->date('form_date')->default(date("Y-m-d"));
            $table->date('to_date')->default(date("Y-m-d"));
            $table->integer('number_of_days')->unsigned()->default(0);
            $table->integer('leaves_taken')->unsigned()->default(0);
            $table->text('description')->nullable();
            $table->text('reason')->nullable();
            $table->boolean('state')->default(false);
            $table->integer('manager_id')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->foreignId('leave_type_id')->constrained()->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('leave_requests');
    }
}
