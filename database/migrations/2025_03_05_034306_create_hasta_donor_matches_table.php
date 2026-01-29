<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hasta_donor_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hasta_id')->constrained('hastas')->onDelete('cascade');
            $table->foreignId('donor_id')->constrained('donors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasta_donor_matches');
    }
};
