<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks_infos', function (Blueprint $table) {
            $table->id();
            $table->string('task_title');
            $table->text('task_description'); // Changed to text for longer content
            $table->date('task_due_date');
            $table->enum('task_priority', ['high', 'medium', 'low'])->default('medium');
            $table->enum('task_status', ['pending', 'process', 'completed'])->default('pending');
            $table->foreignId('task_assigned_to')->constrained('user_infos');
            $table->foreignId('task_created_by')->constrained('user_infos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks_infos');
    }
};
