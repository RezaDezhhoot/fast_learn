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
        \App\Models\SandboxQuestion::query()->insert([
            [
                'text' => 'رئیس جمهور آمریکا که بمب اتمی را به روی مردم شهر هیروشیما ریخت چه کسی بود؟',
            ],
            [
                'text' => 'پدر شعر نو لقب کیست؟',
            ],
            [
                'text' => 'کدام درخت نماد صلح است؟',
            ],
            [
                'text' => 'نام مخترع موتورسیکلت کیست؟'
            ]
        ]);
    }
};
