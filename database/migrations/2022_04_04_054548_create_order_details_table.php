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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->nullable();
            $table->longText('product_data');
            $table->unsignedBigInteger('price');
            $table->decimal('reduction_amount',40);
            $table->decimal('wallet_amount',40);
            $table->unsignedBigInteger('total_price');
            $table->unsignedMediumInteger('quantity');
            $table->bigInteger('order_id')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('order_details');
    }
};
