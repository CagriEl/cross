<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testler', function (Blueprint $table) {
            if (! Schema::hasColumn('testler', 'ad')) {
                $table->string('ad')->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('testler', function (Blueprint $table) {
            if (Schema::hasColumn('testler', 'ad')) {
                $table->dropColumn('ad');
            }
        });
    }
};
