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
        Schema::create('mock_endpoints', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('mock_project_id')->constrained()->cascadeOnDelete();
            $table->string('method');
            $table->string('path');
            $table->json('schema');
            $table->unsignedSmallInteger('status_code')->default(200);
            $table->unsignedInteger('delay_ms')->default(0);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mock_endpoints');
    }
};
