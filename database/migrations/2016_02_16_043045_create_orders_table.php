<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_order');
            $table->integer('quantity');
            $table->integer('total_price');
            $table->tinyint('statusz'); /* status pembayaran..
                                        default: 0 = belum dibayar
                                                1 = terbayar.. manual oleh admin
                                        */
              //user info
            $table->string('name');
            $table->string('address');
            $table->string('id_no'); //nomor ktp atau ktm
            $table->string('id_type'); //jenis tipe : ktm / ktp / kartupelajar

            $table->timestamps(); // created at and updated at
            $table->timestamp('expired_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
