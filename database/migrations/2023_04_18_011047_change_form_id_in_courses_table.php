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
        Schema::table('courses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('form_id');
            $table->foreignId('poll_id')->nullable()->constrained('polls')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->foreignId('form_id')->nullable()->constrained('forms')->nullOnDelete();
            $table->dropConstrainedForeignId('poll_id');
        });
    }
};
