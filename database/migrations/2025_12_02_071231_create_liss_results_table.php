<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('liss_results', function (Blueprint $table) {
            $table->id();

            // Hangi karta ait?
            $table->foreignId('kart_id')
                ->constrained('kartlar') // senin kart tablon 'kartlar'
                ->cascadeOnDelete();

            // R satırındaki temel alanlar (hepsi nullable - protokolde yoksa boş kalacak)
            $table->string('sonuc_siparis_no')->nullable();     // Result Order ID
            $table->string('test_id_raw')->nullable();          // Ham Test ID alanı
            $table->string('cardlis_id')->nullable();           // CardLisID
            $table->string('test_name')->nullable();            // Test Name
            $table->text('sonuc_ham')->nullable();              // A=4+^B=-^AB=4+ ... gibi tüm sonuç stringi

            $table->char('normallik', 1)->nullable();           // N / Y vb.
            $table->char('sonuc_tipi', 1)->nullable();          // F vb.

            $table->string('operator')->nullable();             // Sonucu onaylayan kullanıcı

            $table->dateTime('test_baslama')->nullable();       // YYYYMMDDHHNNSS'den pars edilecek
            $table->dateTime('test_bitis')->nullable();

            // Cihaz bilgileri
            $table->string('device_name')->nullable();
            $table->string('device_serial')->nullable();
            $table->string('device_software_version')->nullable();

            // Resim bilgisi
            $table->string('pic_name')->nullable();
            $table->integer('pic_length')->nullable();
            $table->text('pic_info')->nullable();

            // İstersen ham R satırını da saklayalım
            $table->text('raw_line')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('liss_results');
    }
};
