<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hastas', function (Blueprint $table) {
            if (! Schema::hasColumn('hastas', 'kayit_tipi')) {
                $table->string('kayit_tipi')
                    ->default('hasta')   // istersen default verebilirsin
                    ->after('aciliyet_derecesi');
            }
        });
    }

    public function down(): void
    {
        Schema::table('hastas', function (Blueprint $table) {
            if (Schema::hasColumn('hastas', 'kayit_tipi')) {
                $table->dropColumn('kayit_tipi');
            }
        });
    }
};
