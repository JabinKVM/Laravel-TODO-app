<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {

            $table->id();

            // Student who receives the task
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // School who created the task
            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('title');

            $table->text('description')->nullable();

            $table->enum('priority', [
                'High',
                'Medium',
                'Low'
            ])->default('Medium');

            $table->date('due_date')->nullable();

            $table->boolean('completed')->default(false);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};