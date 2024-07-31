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
        Schema::table('episode_quizzes', function (Blueprint $table) {
            $table->integer('coins')->default(0)->nullable();
            $table->integer('questions_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('episode_quizzes', function (Blueprint $table) {
            $table->dropColumn(['coins','questions_count']);
        });
    }
};
