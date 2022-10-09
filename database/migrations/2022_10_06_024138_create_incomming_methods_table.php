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
        Schema::create('incomming_methods', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->string('value')->nullable();
            $table->integer('expire_limit')->nullable();
            $table->integer('counr_limit')->nullable();
            $table->longText('formola')->nullbale();
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
        Schema::dropIfExists('incomming_methods');
    }
};
