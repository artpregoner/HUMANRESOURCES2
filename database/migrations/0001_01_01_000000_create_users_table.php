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

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('role', ['employee', 'hr', 'admin'])->default('employee');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_login')->nullable();
            //new line for future features based on claude AI
            $table->string('last_login_ip', 45)->nullable(); // Store IPv6 addresses
            $table->boolean('mfa_enabled')->default(false);
            $table->string('mfa_secret')->nullable();
            $table->integer('failed_login_attempts')->default(0);
            $table->timestamp('locked_until')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Add index for faster security lookups
            $table->index(['email', 'is_active']);
            $table->index('last_login');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Schema::create('departments', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name', 100)->unique();
        //     $table->text('description')->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('employee_details', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        //     $table->unsignedBigInteger('department_id')->nullable(); // Define as nullable first
        //     $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null'); // Then add foreign key
        //     $table->string('designation', 100);
        //     $table->date('joining_date');
        //     $table->string('employee_code', 20)->unique()->nullable();
        //     $table->string('employment_status', 20)->nullable();
        //     $table->string('work_location', 100)->nullable();
        //     $table->decimal('salary', 10, 2)->nullable();
        //     $table->string('bank_account_number', 50)->nullable();
        //     $table->string('bank_name', 100)->nullable();
        //     $table->string('tax_id', 50)->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('personal_information', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        //     $table->string('first_name', 50);
        //     $table->string('middle_name', 50)->nullable();
        //     $table->string('last_name', 50);
        //     $table->date('date_of_birth')->nullable();
        //     $table->string('gender', 20)->nullable();
        //     $table->string('marital_status', 20)->nullable();
        //     $table->string('blood_group', 5)->nullable();
        //     $table->string('nationality', 50)->nullable();
        //     $table->text('address')->nullable();
        //     $table->string('city', 50)->nullable();
        //     $table->string('state', 50)->nullable();
        //     $table->string('country', 50)->nullable();
        //     $table->string('postal_code', 20)->nullable();
        //     $table->string('phone_number', 20)->nullable();
        //     $table->string('emergency_contact_name', 100)->nullable();
        //     $table->string('emergency_contact_number', 20)->nullable();
        //     $table->string('emergency_relationship')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('personal_information');
        // Schema::dropIfExists('employee_details');
        // Schema::dropIfExists('departments');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
