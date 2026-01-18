<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();

            $table->string('title'); // Rent / Salary / Event
            $table->string('category')->index(); // Office, Event, Program
            $table->decimal('amount', 10, 2);

            $table->date('expense_date')->index();
             $table->foreignId('campaign_id')->nullable()->constrained()->onDelete('set null');
            $table->string('payment_mode'); // Cash, Bank, UPI
            $table->string('reference_no')->nullable();

            $table->string('paid_to')->nullable(); // Vendor / Person
            $table->string('bill_path')->nullable(); // Receipt PDF/Image

            $table->text('remarks')->nullable();

            $table->enum('status', ['Pending', 'Approved', 'Rejected'])
                  ->default('Approved');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
