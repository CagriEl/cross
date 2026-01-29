<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kullanici_izinleri', function (Blueprint $table) {
            $table->boolean('cihaz_ekleme')->default(false);
            $table->boolean('hastane_ekleme')->default(false);
            $table->boolean('kart_ekleme')->default(false);
            $table->boolean('sonuc_ekleme')->default(false);
            $table->boolean('test_ekleme')->default(false);
            $table->boolean('kullanici_ekleme')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('kullanici_izinleri', function (Blueprint $table) {
            $table->dropColumn([
                'cihaz_ekleme',
                'hastane_ekleme',
                'kart_ekleme',
                'sonuc_ekleme',
                'test_ekleme',
                'kullanici_ekleme',
            ]);
        });
    }
};
