<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilePathsToCmatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cmatches', function (Blueprint $table) {
            if (! Schema::hasColumn('cmatches', 'file_1')) {
                $table->string('file_1')->nullable()->after('id');
            }
            if (! Schema::hasColumn('cmatches', 'file_2')) {
                $table->string('file_2')->nullable()->after('file_1');
            }
            if (! Schema::hasColumn('cmatches', 'file_3')) {
                $table->string('file_3')->nullable()->after('file_2');
            }
            if (! Schema::hasColumn('cmatches', 'file_4')) {
                $table->string('file_4')->nullable()->after('file_3');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cmatches', function (Blueprint $table) {
            if (Schema::hasColumn('cmatches', 'file_4')) {
                $table->dropColumn('file_4');
            }
            if (Schema::hasColumn('cmatches', 'file_3')) {
                $table->dropColumn('file_3');
            }
            if (Schema::hasColumn('cmatches', 'file_2')) {
                $table->dropColumn('file_2');
            }
            if (Schema::hasColumn('cmatches', 'file_1')) {
                $table->dropColumn('file_1');
            }
        });
    }
}
