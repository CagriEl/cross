<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestlerTable extends Migration
{
    public function up()
    {
        Schema::create('testler', function (Blueprint $table) {
            $table->id();
            $table->string('test_adi');
            $table->foreignId('cihaz_id')->constrained()->onDelete('cascade');
            $table->string('test_dosya')->nullable(); // Yeni sütun
            $table->timestamps();
        });
        
        
    }
    public function cihaz()
    {
        return $this->belongsTo(Cihaz::class);
    }

    public function down()
    {
        Schema::dropIfExists('testler');
    }
}


