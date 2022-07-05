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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('sub_title');
            $table->longText('short_body');
            $table->longText('long_body');
            $table->string('level');
            $table->text('image');
            $table->integer('category_id')->nullable();
            $table->integer('quiz_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->string('status');
            $table->string('reduction_type')->nullable();
            $table->string('reduction_value')->nullable();
            $table->text('seo_keywords');
            $table->text('seo_description');
            $table->string('start_at')->nullable();
            $table->string('expire_at')->nullable();
            $table->decimal('const_price',55);
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
        Schema::dropIfExists('courses');
    }
};
