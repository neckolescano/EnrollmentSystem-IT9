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
    Schema::create('sections', function (Blueprint $table) {
        $table->id('section_id');
        $table->foreignId('subject_id')->constrained('subjects', 'subject_id');
        $table->foreignId('instructor_id')->constrained('instructors', 'instructor_id');
        $table->string('semester');
        $table->string('school_year');
        $table->string('schedule');
        $table->integer('capacity'); // Business Rule #4
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
