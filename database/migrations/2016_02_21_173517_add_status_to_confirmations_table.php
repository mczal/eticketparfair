<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('confirmations', function (Blueprint $table) {
            //
            $table->tinyInteger('status'); /*
                                            * 0 = belum di validasi
                                            * 1 = sudah di validasi
                                            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('confirmations', function (Blueprint $table) {
            //
        });
    }
}
