<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->datetime('order_date');
            $table->string('order_number'); // Изменено на string
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade');
            $table->decimal('total_amount', 10, 2)->default(0); // Изменено на decimal
            $table->string('id_cell')->nullable(); // Изменено на string
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};





// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         Schema::create('orders', function (Blueprint $table) {
//             $table->id();
//             $table->datetime('order_date');
//             $table->integer('order_number');
//             $table->integer('customer_id')->nullable(true);
//             $table->integer('total_amount')->default(0);
//             $table->integer('id_cell')->nullable(true);
//         });
//     }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         Schema::dropIfExists('orders');
//     }
// };
