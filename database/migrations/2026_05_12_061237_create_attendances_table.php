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
        Schema::create('attendances', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('employee_id');

            $table->date('attendance_date');

            $table->time('check_in')->nullable();

            $table->time('check_out')->nullable();

            $table->decimal('working_hours', 5, 2)->default(0);

            $table->boolean('is_late')->default(false);

            $table->enum('status', [
                'present',
                'absent',
                'pending'
            ])->default('pending');

            $table->boolean('is_approved')->default(false);

            $table->timestamp('approved_at')->nullable();

            $table->timestamps();

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
