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
        Schema::create('episode_quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('episode_id')->index();
            $table->string('title');
            $table->string('type');
            $table->time('at')->nullable();
            $table->integer('timer');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episode_quizzes');
    }
};
