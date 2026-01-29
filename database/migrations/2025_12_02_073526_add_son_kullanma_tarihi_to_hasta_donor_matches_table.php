<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasta_donor_matches', function (Blueprint $table) {
            if (! Schema::hasColumn('hasta_donor_matches', 'son_kullanma_tarihi')) {
                $table->date('son_kullanma_tarihi')
                    ->nullable()
                    ->after('cmatch_id'); // istersen başka kolonun yanına al
            }
        });
    }

    public function down(): void
    {
        Schema::table('hasta_donor_matches', function (Blueprint $table) {
            if (Schema::hasColumn('hasta_donor_matches', 'son_kullanma_tarihi')) {
                $table->dropColumn('son_kullanma_tarihi');
            }
        });
    }
};
