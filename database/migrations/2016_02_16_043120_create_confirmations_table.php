<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_rekening');
            $table->string('nama_bank');
            $table->integer('total_transfer');

            $table->integer('order')->unsigned(); // from
            $table->timestamps(); // untuk created dan updated

            //constraint
            $table->foreign('order')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('confirmations');
    }
}
