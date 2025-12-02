<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasta_donor_matches', function (Blueprint $table) {
            if (! Schema::hasColumn('hasta_donor_matches', 'cmatch_id')) {
                $table->foreignId('cmatch_id')
                    ->nullable()
                    ->constrained('cmatches')   // cmatches tablosuna FK
                    ->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('hasta_donor_matches', function (Blueprint $table) {
            if (Schema::hasColumn('hasta_donor_matches', 'cmatch_id')) {
                $table->dropConstrainedForeignId('cmatch_id');
            }
        });
    }
};
