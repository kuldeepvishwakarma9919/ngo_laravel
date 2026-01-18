<?php




use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('compliance_documents', function (Blueprint $table) {
            $table->id();

            $table->string('title'); 
            $table->string('doc_type'); 
            $table->string('doc_number')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();

            $table->string('file_path'); 
            $table->string('authority')->nullable(); 

            $table->enum('status',['active','expired','pending'])
                  ->default('active');

            $table->boolean('is_public')->default(false);
            $table->text('remarks')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compliance_documents');
    }
};
