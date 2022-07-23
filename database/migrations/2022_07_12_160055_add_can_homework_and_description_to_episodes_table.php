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
        Schema::table('episodes', function (Blueprint $table) {
            $table->string('description');
            $table->tinyInteger('can_homework');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('episodes', function (Blueprint $table) {
            if (
                Schema::hasColumn('episodes', 'description') &&
                Schema::hasColumn('episodes', 'can_homework')
            ) {
                $table->dropColumn('description');
                $table->dropColumn('can_homework');
            }
        });
    }
};
