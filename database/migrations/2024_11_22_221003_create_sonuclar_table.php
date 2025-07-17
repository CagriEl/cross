<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSonuclarTable extends Migration
{
    public function up()
    {
        Schema::create('sonuclar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kart_id')->constrained('kartlar')->onDelete('cascade');
            $table->foreignId('test_id')->constrained('testler')->onDelete('cascade');
            $table->string('sonuc');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sonuclar');
    }

}
