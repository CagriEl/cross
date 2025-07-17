<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('testler', function (Blueprint $table) {
        $table->unsignedBigInteger('cihaz_id')->nullable()->after('test_adi');
        $table->foreign('cihaz_id')->references('id')->on('cihazlar')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('testler', function (Blueprint $table) {
        $table->dropForeign(['cihaz_id']);
        $table->dropColumn('cihaz_id');
    });
}

};
