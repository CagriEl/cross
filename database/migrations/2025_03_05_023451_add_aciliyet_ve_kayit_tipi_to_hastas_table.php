<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('hastas', function (Blueprint $table) {
            $table->enum('aciliyet_derecesi', ['kritik', 'acil', 'normal'])->default('normal')->after('kan_grubu');
            $table->enum('kayit_tipi', ['hasta', 'donor'])->default('hasta')->after('aciliyet_derecesi');
        });
    }

    public function down(): void
    {
        Schema::table('hastas', function (Blueprint $table) {
            $table->dropColumn(['aciliyet_derecesi', 'kayit_tipi']);
        });
    }
};
