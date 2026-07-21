<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('tasks');

        Schema::create('tasks', function (Blueprint $table) {

            $table->id();

            $table->foreignId('school_id')->constrained()->cascadeOnDelete();

            $table->foreignId('student_id')->constrained()->cascadeOnDelete();

            $table->string('title');

            $table->text('description')->nullable();

            $table->enum('priority',[
                'Low',
                'Medium',
                'High'
            ])->default('Medium');

            $table->date('due_date')->nullable();

            $table->enum('status',[
                'Pending',
                'Completed'
            ])->default('Pending');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};