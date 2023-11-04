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
        Schema::table('episode_transcripts', function (Blueprint $table) {
            $table->foreignId('chapter_transcript_id')->nullable()->constrained('chapter_transcripts')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('episode_transcripts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('chapter_transcript_id');
        });
    }
};
