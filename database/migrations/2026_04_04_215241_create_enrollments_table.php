<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
             $table->id();
            $table->string('student_id');
            $table->string('student_name');
            $table->string('semester');
            $table->string('school_year');
            $table->string('status')->default('Pending'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollment');
    }
};
