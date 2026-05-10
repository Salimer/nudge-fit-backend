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
        Schema::create('scheduled_nudges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accountability_log_id')->constrained()->cascadeOnDelete();
            $table->string('nudge_type');
            $table->time('target_time');
            $table->string('status')->default('pending');
            $table->string('push_title');
            $table->string('push_body');
            $table->string('sender_name');
            $table->text('in_app_message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduled_nudges');
    }
};
