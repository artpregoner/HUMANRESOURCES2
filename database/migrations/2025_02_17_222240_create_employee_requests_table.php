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
        Schema::create('employee_requests', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->date('birthdate');
            $table->enum('gender', ['Male', 'Female']);
            $table->enum('civil_status', ['single', 'married', 'divorced', 'widowed', 'separated', 'engaged']);
            $table->text('address');
            $table->string('social_media')->nullable();
            $table->enum('department', ['admin', 'hr1', 'hr2', 'hr3', 'finance', 'logistic1', 'logistic2', 'core1', 'core2', 'core3']);
            $table->string('role');

            // Emergency Contact
            $table->string('emergency_name');
            $table->text('emergency_address');
            $table->string('emergency_phone');
            $table->string('emergency_relationship');

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Admin Approval
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete(); // Admin User ID
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_requests');
    }
};
