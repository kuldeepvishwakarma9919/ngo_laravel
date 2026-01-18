<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tax_certificates', function (Blueprint $table) {
            $table->id(); // BIGINT AUTO_INCREMENT PRIMARY KEY

            $table->unsignedBigInteger('donation_id');

            $table->string('certificate_no', 50)->unique();
            $table->date('issued_date')->nullable();
            $table->string('financial_year', 20)->nullable();
            $table->string('certificate_path', 255)->nullable();

            $table->timestamps();

            // Foreign Key
            $table->foreign('donation_id')
                  ->references('id')
                  ->on('donations')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tax_certificates');
    }
};
