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
        Schema::table('episodes', function (Blueprint $table) {
            $table->tinyInteger('show_api_video')->default(1)->after('video_storage');
            $table->tinyInteger('downloadable_local_video')->default(1)->after('show_api_video');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('episodes', 'show_api_video') && Schema::hasColumn('episodes', 'downloadable_local_video')) {
            Schema::table('episodes', function (Blueprint $table) {
                $table->dropColumn('show_api_video');
                $table->dropColumn('downloadable_local_video');
            });
        }
        
    }
};
