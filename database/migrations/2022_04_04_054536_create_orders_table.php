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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('user_ip');
            $table->decimal('price',25);
            $table->decimal('total_price',25);
            $table->string('reduction_code')->nullable();
            $table->decimal('reductions_value',25)->nullable();
            $table->decimal('discount',25)->nullable();
            $table->unsignedInteger('wallet_pay');
            $table->string('transactionId')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
