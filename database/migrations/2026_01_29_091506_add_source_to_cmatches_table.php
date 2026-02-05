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
    Schema::table('cmatches', function (Blueprint $table) {
        // Eğer status sütunu yoksa ekle
        if (!Schema::hasColumn('cmatches', 'status')) {
            $table->string('status')->default('pending'); // 'after' kullanmadık, en sona ekler
        }

        // source sütununu ekle
        if (!Schema::hasColumn('cmatches', 'source')) {
            $table->string('source')->default('manual');
        }
    });
}

public function down()
{
    Schema::table('cmatches', function (Blueprint $table) {
        // Geri alırken sütunları sil
        if (Schema::hasColumn('cmatches', 'source')) {
            $table->dropColumn('source');
        }
        if (Schema::hasColumn('cmatches', 'status')) {
            $table->dropColumn('status');
        }
    });
}
};
