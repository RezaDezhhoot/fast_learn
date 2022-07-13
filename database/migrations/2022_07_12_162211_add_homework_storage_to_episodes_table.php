<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('episodes', 'homework_storage')) {
            Schema::table('episodes', function (Blueprint $table) {
                $table->integer('homework_storage')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('episodes', 'homework_storage')) {
            Schema::table('episodes', function (Blueprint $table) {
                $table->dropColumn('homework_storage');
            });
        }

    }
};
