<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('attendance_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            // $table->timestamp('present_time')->nullable();
            // $table->timestamp('check_in_time')->nullable();
            // $table->timestamp('check_out_time')->nullable();
            // $table->timestamp('going_time')->nullable();
            $table->dateTime('present_time')->nullable();     
            $table->dateTime('check_in_time')->nullable();    
            $table->dateTime('check_out_time')->nullable();   
            $table->dateTime('going_time')->nullable();       

            $table->integer('total_work_seconds')->nullable();
            $table->integer('total_break_seconds')->nullable();
            $table->timestamps();
        });
    }


};
