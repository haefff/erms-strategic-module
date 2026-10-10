<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kri_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('risk_register_id')->constrained()->cascadeOnDelete();
            $table->foreignId('kri_id')->nullable()->constrained('kris')->nullOnDelete();
            $table->foreignId('sub_kri_id')->nullable()->constrained('sub_kris')->nullOnDelete();
            $table->foreignId('submitted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status', 20)->default('pending'); // pending, approved, rejected
            $table->text('remarks')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kri_approvals');
    }
};