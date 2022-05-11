<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('employee_id')->unsigned(); 
            $table->dateTime('check_in');
            $table->dateTime('check_out')->nullable();
            $table->dateTime('time')->nullable();
            $table->enum('status',['in','out'])->default('in');
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
        Schema::table('checks', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
        });

        Schema::dropIfExists('checks');
    }
}
