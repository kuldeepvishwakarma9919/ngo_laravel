<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('id_card_verifications', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('member_id');
            $table->string('verification_code');
            $table->timestamp('verified_at')->nullable();
            $table->timestamps(); 
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('id_card_verifications');
    }
};
