<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('blog_categories')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique(); 
            $table->string('author_name')->default('NGO Admin');
            $table->text('short_description')->nullable(); 
            $table->longText('content');
            $table->string('featured_image'); 
            $table->string('video_url')->nullable(); 
            $table->enum('status', ['draft', 'published', 'scheduled'])->default('draft');
            $table->integer('view_count')->default(0); 
            $table->boolean('is_featured')->default(false); 
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamp('published_at')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
