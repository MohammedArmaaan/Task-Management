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
    //     Schema::create('attendance_infos', function (Blueprint $table) {
    //     $table->id();
    //     $table->unsignedBigInteger('user_id');
    //     $table->date('date');
    //     $table->time('present_time')->nullable();
    //     $table->time('check_in_time')->nullable();
    //     $table->time('check_out_time')->nullable();
    //     $table->time('going_time')->nullable();
    //     $table->integer('total_work_seconds')->nullable(); // calculated
    //     $table->integer('total_break_seconds')->nullable(); // calculated
    //     $table->timestamps();

    //     $table->foreign('user_id')->references('id')->on('user_infos')->onDelete('cascade');
    // });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
