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
        Schema::create('organ_information', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->longText('documents')->nullable();
            $table->string('web_site')->nullable();
            $table->foreignId('organ_id')->constrained('organs')->cascadeOnDelete();
            $table->longText('transcript')->nullable();
            $table->string('status');
            $table->decimal('rating')->default(0);
            $table->text('logo')->nullable();
            $table->text('image')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('organ_information');
    }
};
