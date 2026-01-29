<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('donors', function (Blueprint $table) {
            $table->date('son_kullanma_tarihi')->nullable()->after('kan_grubu');
        });
    }

    public function down(): void
    {
        Schema::table('donors', function (Blueprint $table) {
            $table->dropColumn('son_kullanma_tarihi');
        });
    }
};
