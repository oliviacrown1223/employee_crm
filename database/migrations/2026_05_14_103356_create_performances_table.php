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
        Schema::create('performances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')->constrained()->onDelete('cascade');

            // KPI Fields
            $table->integer('attendance_score')->default(0);
            $table->integer('task_completion_score')->default(0);
            $table->integer('manager_rating')->default(0);

            // System Generated
            $table->integer('final_rating')->nullable();
            $table->string('rating_grade')->nullable(); // A+, A, B etc
     // A+, A, B etc

            $table->string('month');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performances');
    }
};
