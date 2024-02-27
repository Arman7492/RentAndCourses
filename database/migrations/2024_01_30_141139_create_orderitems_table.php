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
        Schema::create('orderitems', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable(true);
            $table->integer('product_id')->nullable(true);
            $table->float('unit_price')->default(0);
            $table->float('total_amount')->default(0);
            $table->integer('quantity')->default(0);
            $table->integer('instructor_id')->nullable(true);
            $table->float('rent_price')->default(0);
            $table->datetime('return_date')->nullable(false);            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderitems');
    }
};
