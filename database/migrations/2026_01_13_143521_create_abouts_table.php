<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();

            // Basic About Content
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // Vision & Mission
            $table->longText('vision')->nullable();
            $table->longText('mission')->nullable();

            // History / Story
            $table->longText('history')->nullable();

            // Impact Counters
            $table->integer('years_of_experience')->nullable();
            $table->integer('total_volunteers')->nullable();
            $table->integer('total_beneficiaries')->nullable();

            // Media
            $table->string('banner_image')->nullable();
            $table->string('about_image')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            // Status
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
