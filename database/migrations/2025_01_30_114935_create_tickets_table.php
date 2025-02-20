<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ticket_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->text('description')->nullable(); // Optional description of the category
            $table->boolean('is_active')->default(true); // To soft-disable a category
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Ticket creator
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('ticket_category_id')->nullable()->constrained('ticket_categories')->nullOnDelete();
            $table->string('title');
            $table->text('description');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->enum('status', ['open', 'in_progress', 'resolved', 'closed'])->default('open');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete()->after('deleted_at');
            $table->timestamps();
            $table->softDeletes(); // Soft delete
        });

        Schema::create('ticket_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('response_text');
            $table->timestamp('responded_at')->useCurrent(); // Defaults to now
            $table->timestamps();
            $table->softDeletes(); // Soft delete for responses
        });

        Schema::create('ticket_response_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_response_id')->constrained('ticket_responses')->onDelete('cascade');
            $table->text('file_path');
            $table->string('file_name');
            $table->string('file_type');
            $table->unsignedBigInteger('file_size')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Soft delete for file uploads
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_response_files');
        Schema::dropIfExists('ticket_responses');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('ticket_categories');
    }
};
