<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->Increments('id'); 
            $table->integer('employee_id')->unsigned();
            $table->boolean('state')->default(0);
            
            $table->time('check_out')->default(date("H:i:s"));
            $table->date('check_in')->default(date("Y-m-d"));
            $table->boolean('status')->default(1);
            $table->boolean('type')->unsigned()->default(1);
            $table->foreignId('leave_type_id')->constrained()->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
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
        
        Schema::table('leaves', function (Blueprint $table) {
         $table->dropForeign(['employee_id']);
        });

        Schema::dropIfExists('leaves');
    }
}
