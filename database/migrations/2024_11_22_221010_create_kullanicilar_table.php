<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKullanicilarTable extends Migration
{
    public function up()
    {
        Schema::create('kullanicilar', function (Blueprint $table) {
            $table->id();
            $table->string('kullanici_adi');
            $table->string('telefon')->nullable(); // Telefon ekleniyor
            $table->foreignId('rol_id')->constrained('kullanici_izinleri')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('kullanicilar');
    }
}
