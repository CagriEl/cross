<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCihazlarTable extends Migration
{
    public function up()
    {
        Schema::create('cihazlar', function (Blueprint $table) {
            $table->id();
            $table->string('cihaz_adi');
            $table->foreignId('hastane_id')->constrained('hastaneler')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cihazlar');
    }
}
