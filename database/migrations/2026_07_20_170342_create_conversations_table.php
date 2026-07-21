<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {

            $table->id();

            $table->foreignId('school_user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('student_user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamp('last_message_at')->nullable();

            $table->timestamps();

            // One conversation per School-Student pair
            $table->unique(['school_user_id', 'student_user_id']);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};