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
        Schema::table('new_course_requests', function (Blueprint $table) {
            $table->foreignId('organ_id')->nullable()->constrained('organs')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_course_requests', function (Blueprint $table) {
            $table->dropConstrainedForeignId('organ_id');
        });
    }
};
