<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kartlar', function (Blueprint $table) {
            if (! Schema::hasColumn('kartlar', 'test_id')) {
                $table->foreignId('test_id')
                    ->nullable()
                    ->constrained('testler') // ÖNEMLİ: testler
                    ->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('kartlar', function (Blueprint $table) {
            if (Schema::hasColumn('kartlar', 'test_id')) {
                $table->dropConstrainedForeignId('test_id');
            }
        });
    }
};
