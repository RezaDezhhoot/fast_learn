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
        Schema::create('episode_transcripts', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->longText('message')->nullable();
            $table->string('title');
            $table->longText('file')->nullable();
            $table->string('link')->nullable();
            $table->longText('local_video')->nullable();
            $table->tinyInteger('allow_show_local_video')->default(0);
            $table->longText('api_bucket')->nullable();
            $table->time('time')->nullable();
            $table->integer('view')->default(0);
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->bigInteger('episode_id')->unsigned()->nullable();
            $table->tinyInteger('free')->default(0);
            $table->string('file_storage')->default(1);
            $table->string('video_storage')->default(1);
            $table->tinyInteger('show_api_video')->default(1);
            $table->tinyInteger('downloadable_local_video')->default(1);
            $table->string('description');
            $table->integer('can_homework');
            $table->string('homework_storage')->nullable();
            $table->tinyInteger('is_confirmed')->default(0);
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
        Schema::dropIfExists('episode_transcripts');
    }
};
