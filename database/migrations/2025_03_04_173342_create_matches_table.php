<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->string('file_1_name'); // İlk yüklenen Excel dosyası
            $table->string('file_2_name'); // İkinci yüklenen Excel dosyası
            $table->json('matched_records')->nullable(); // Eşleşen kayıtlar JSON formatında saklanacak
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
