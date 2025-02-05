<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ticket_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('response_text');
            $table->timestamp('responded_at')->useCurrent(); // Defaults to now
            $table->timestamps();
            $table->softDeletes(); // Soft delete for responses
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_responses');
    }
};

