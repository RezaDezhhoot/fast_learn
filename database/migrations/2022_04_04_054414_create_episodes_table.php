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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('file')->nullable();
            $table->string('link')->nullable();
            $table->longText('local_video')->nullable();
            $table->tinyInteger('allow_show_local_video')->default(0);
            $table->longText('api_bucket')->nullable();
            $table->time('time')->nullable();
            $table->integer('view')->default(0);
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->tinyInteger('free')->default(0);
            $table->integer('file_storage')->default(1);
            $table->integer('video_storage')->default(1);
            $table->string('file_upload_method')->nullable();
            $table->string('video_upload_method')->nullable();
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
        Schema::dropIfExists('episodes');
    }
};
