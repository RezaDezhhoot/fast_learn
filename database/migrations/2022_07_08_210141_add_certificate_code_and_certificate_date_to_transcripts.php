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
        Schema::table('transcripts', function (Blueprint $table) {
            $table->string('certificate_code')->nullable()->unique();
            $table->string('certificate_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transcripts', function (Blueprint $table) {
            if (
                Schema::hasColumn('transcripts', 'certificate_code') &&
                Schema::hasColumn('transcripts', 'certificate_date')
            ) {
                $table->dropColumn('certificate_code');
                $table->dropColumn('certificate_date');
            }
        });
    }
};
