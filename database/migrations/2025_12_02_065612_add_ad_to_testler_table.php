<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testler', function (Blueprint $table) {
            // Eğer daha önce yoksa "ad" alanını ekliyoruz
            if (! Schema::hasColumn('testler', 'test_adi')) {
                $table->string('test_adi')->nullable()->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('testler', function (Blueprint $table) {
            if (Schema::hasColumn('testler', 'ad')) {
                $table->dropColumn('ad');
            }
        });
    }
};
