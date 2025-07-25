<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cmatches', function (Blueprint $table) {
            $table->id();
            $table->string('file_1')->nullable();
            $table->string('file_1_name')->nullable();
            $table->string('file_2')->nullable();
            $table->string('file_2_name')->nullable();
            $table->json('matched_records')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cmatches');
    }
};