<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('id_card_type', 50)->nullable()->after('qualification');
            $table->string('id_card_front')->nullable()->after('id_card_type');
            $table->string('id_card_back')->nullable()->after('id_card_front');
            $table->string('mobile_no')->nullable()->after('id_card_back');
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn([
                'id_card_type',
                'id_card_front',
                'id_card_back',
                'mobile_no'
            ]);
        });
    }
};

