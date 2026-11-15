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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
             $table->foreignId('user_id')
                   ->unique()
                   ->constrained('users')
                   ->cascadeOnDelete();
            $table->string('course_code');
            $table->string('title')->unique();
            $table->timestamp('credit_hours')->nullable();
            $table->string('semester');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
