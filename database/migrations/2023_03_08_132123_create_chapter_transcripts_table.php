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
        Schema::create('chapter_transcripts', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->longText('message')->nullable();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->bigInteger('chapter_id')->unsigned()->nullable();
            $table->string('title');
            $table->integer('view')->default(0);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('chapter_transcripts');
    }
};
