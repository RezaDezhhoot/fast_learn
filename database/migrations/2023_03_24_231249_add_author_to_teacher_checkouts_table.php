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
        Schema::table('teacher_checkouts', function (Blueprint $table) {
            $table->string('author')->default(\App\Enums\CheckoutEnum::TYPE_TEACHER);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher_checkouts', function (Blueprint $table) {
            $table->dropColumn('author');
        });
    }
};
