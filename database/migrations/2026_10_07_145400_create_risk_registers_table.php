<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('risk_registers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ptj_id')->constrained('ptjs')->restrictOnDelete();

            $table->string('risk_number', 50)->nullable();
            $table->unsignedSmallInteger('year');
            $table->text('risk_description');
            $table->string('risk_owner')->nullable();
            $table->date('registered_date')->nullable();
            $table->date('updated_date')->nullable();

            // Assessment scores
            $table->unsignedTinyInteger('likelihood')->nullable();          // P6
            $table->unsignedTinyInteger('human_impact')->nullable();        // P1
            $table->unsignedTinyInteger('reputation_impact')->nullable();   // P2
            $table->unsignedTinyInteger('financial_impact')->nullable();    // P3
            $table->unsignedTinyInteger('operational_impact')->nullable();  // P4
            $table->unsignedTinyInteger('objective_impact')->nullable();    // P5
            $table->decimal('average_score', 5, 2)->nullable();
            $table->decimal('risk_index', 6, 2)->nullable();
            $table->string('risk_level', 30)->nullable();

            $table->text('existing_controls')->nullable();
            $table->text('proposed_controls')->nullable();
            $table->string('status', 100)->nullable();
            $table->string('category', 100)->nullable();
            $table->string('marker', 100)->nullable();
            $table->string('classification', 100)->nullable();

            // High-impact identification (FR5)
            $table->boolean('is_high_impact')->default(false);
            $table->foreignId('high_impact_set_by')->nullable()
                  ->constrained('users')->nullOnDelete();
            $table->timestamp('high_impact_set_at')->nullable();

            // KRI assignment (FR6)
            $table->foreignId('kri_id')->nullable()->constrained('kris')->nullOnDelete();
            $table->foreignId('sub_kri_id')->nullable()->constrained('sub_kris')->nullOnDelete();

            // Duplicate detection during import
            $table->char('import_hash', 64)->nullable()->unique();

            $table->timestamps();

            $table->index(['ptj_id', 'year']);
            $table->index('year');
            $table->index('risk_level');
            $table->index('category');
            $table->index('status');
            $table->index('is_high_impact');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('risk_registers');
    }
};