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
        //i put claims category so admin can configure it.
        Schema::create('claims_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Name of the category (e.g., Travel, Food, Accommodation)
            $table->text('description')->nullable(); // Optional description of the category
            $table->boolean('is_active')->default(true); // To soft-disable a category
            $table->timestamps();
            $table->softDeletes(); // Soft delete for audit purposes
        });

        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Employee who owns the claim
            $table->foreignId('submitted_by_id')->constrained('users')->onDelete('cascade'); // User who submitted the claim (HR/Admin or Employee)
            $table->foreignId('assigned_to_id')->nullable()->constrained('users')->onDelete('set null'); // Assigned to employee (for walk-in employees)
            $table->foreignId('approved_by_id')->nullable()->constrained('users')->onDelete('set null'); // Approved by HR/Admin
            $table->dateTime('expense_date'); // Expense Date
            $table->timestamp('submitted_date')->useCurrent(); // Submitted Date
            $table->date('approved_date')->nullable(); // Approved Date
            $table->string('description'); // Description of the claim
            $table->longText('comments')->nullable(); // Optional comments
            $table->enum('status', ['submitted', 'pending', 'approved', 'rejected', 'unapproved'])->default('submitted'); // Claim status
            $table->boolean('reimbursement_required')->default(true); // Whether reimbursement is required
            $table->decimal('total_amount', 10, 2)->default(0); // Total amount of the claim
            $table->enum('currency', ['PHP', 'USD'])->default('PHP'); //currency field
            $table->timestamp('sent_to_payroll_at')->nullable(); // Sent to Payroll timestamp
            //for payroll system
            $table->enum('payroll_status', ['pending', 'processing', 'paid', 'rejected'])->default('pending'); // Payroll processing status
            $table->timestamp('paid_date')->nullable(); // Date when paid
            $table->longText('payroll_remarks')->nullable(); // Payroll remarks
            $table->string('transaction_reference')->nullable(); // Reference number of the payment transaction
            $table->foreignId('processed_by_id')->nullable()->constrained('users')->nullOnDelete(); // Payroll user who processed it
            //end for payroll
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete()->after('deleted_at');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('claim_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('claim_id')->constrained()->onDelete('cascade'); // Link to the claim
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('claims_categories')->nullOnDelete();
            $table->string('details'); // Details of the expense
            $table->decimal('amount', 10, 2); // Amount of the expense
            $table->enum('currency', ['PHP', 'USD'])->default('PHP'); //currency field
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete()->after('deleted_at');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('claims_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('claim_id')->constrained()->onDelete('cascade'); // Link to the claim
            $table->string('file_name');// Path to the stored file
            $table->string('file_path');// Original file name
            $table->string('file_type');// MIME type of the file
            $table->integer('file_size')->nullable(); // File size in bytes
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete()->after('deleted_at');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('claim_approvers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('claim_id')->constrained()->onDelete('cascade'); // Link to the claim
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // HR/Admin who approved/rejected
            $table->enum('action', ['approved', 'rejected', 'unapproved', 'unrejected', 'status_changed']);
            $table->longText('comments')->nullable(); // Optional comments for approval/rejection
            $table->timestamp('action_at')->nullable();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete()->after('deleted_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claim_approvers'); // Drop dependent tables first
        Schema::dropIfExists('claims_attachments');
        Schema::dropIfExists('claim_items');
        Schema::dropIfExists('claims');
        Schema::dropIfExists('claims_categories'); // Drop this last
    }
};
