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
        Schema::create('organs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('status');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('seo_key_words');
            $table->text('seo_description');
            $table->integer('course_count')->default(0);
            $table->integer('student_count')->default(0);
            $table->boolean('is_new')->default(true);
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
        Schema::dropIfExists('organs');
    }
};
