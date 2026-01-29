<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKartlarTable extends Migration
{
    public function up()
    {
        Schema::create('kartlar', function (Blueprint $table) {
            $table->id();
            $table->string('kart_numarasi')->unique(); // Benzersiz kart numarası
            $table->enum('tip', ['Hasta', 'Donör']); // Kart tipi
            $table->timestamps(); // Oluşturulma ve güncellenme tarihi
        });
    }

    public function down()
    {
        Schema::dropIfExists('kartlar');
    }
}
