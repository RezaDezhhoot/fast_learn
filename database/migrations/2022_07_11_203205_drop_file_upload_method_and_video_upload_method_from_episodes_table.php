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
        if (
            Schema::hasColumn('episodes', 'file_upload_method') &&
            Schema::hasColumn('episodes', 'video_upload_method')
        )
        {
            Schema::table('episodes', function (Blueprint $table) {
                $table->dropColumn('file_upload_method');
                $table->dropColumn('video_upload_method');
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('episodes', function (Blueprint $table) {
            //
        });
    }
};
