<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone', 15)->nullable();
            $table->string('email')->nullable();
            $table->enum('gender', ['male','female','other'])->nullable();
            $table->integer('age')->nullable();
            $table->string('category')->nullable(); // Student / Patient
            $table->string('support_type')->nullable(); // Education / Medical
            $table->text('address')->nullable();
            $table->string('identity_no')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->date('registered_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
