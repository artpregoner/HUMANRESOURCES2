<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
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
    }
};

