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
        Schema::create('_lectures', function (Blueprint $table) {
           $table->id();
            $table->foreignId('course_id')
                   ->unique()
                   ->constrained('courses')
                   ->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('topic_summary');
            $table->string('hall_name')->nullable();
            $table->string('scheduled_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_lectures');
    }
};
