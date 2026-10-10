<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('lpu')->after('password');
            $table->foreignId('ptj_id')->nullable()->after('role')
                  ->constrained('ptjs')->nullOnDelete();
            $table->boolean('is_active')->default(true)->after('ptj_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['ptj_id']);
            $table->dropColumn(['role', 'ptj_id', 'is_active']);
        });
    }
};