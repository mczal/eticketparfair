<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_code')->unique();
            /*barcode belom*/
            $table->integer('type')->unsigned(); //from table types
            /*dari table order belom*/

            $table->timestamp('order_date')->nullable();
            $table->timestamp('active_date')->nullable();
            $table->timestamp('check_in_date')->nullable();

            //constraint
            $table->foreign('type')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tickets');
    }
}
