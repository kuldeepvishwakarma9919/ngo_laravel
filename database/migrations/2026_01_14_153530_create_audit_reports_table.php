<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('financial_year', 10)->index();
            $table->enum('report_type', ['Domestic', 'FCRA', 'ITR', 'Annual_Report', 'Other'])
                ->default('Domestic');
            $table->string('file_path');
            $table->string('file_size')->nullable();
            $table->string('ca_name')->nullable();
            $table->string('udid_number')->nullable();
            $table->text('summary')->nullable();
            $table->boolean('is_public')->default(true);
            $table->integer('download_count')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_reports');
    }
};
