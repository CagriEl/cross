<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHastanelerTable extends Migration
{
    public function up()
    {
        Schema::create('hastaneler', function (Blueprint $table) {
            $table->id();
            $table->string('hastane_adi');
            $table->string('hastane_adres');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hastaneler');
    }
}
