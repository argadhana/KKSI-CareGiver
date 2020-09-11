<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForignKeyTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('esccort_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('lansia_id')
                ->constrained()
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksis',function (Blueprint $table){
            $table->dropForign(['user_id']);
            $table->dropForign(['esccort_id']);
            $table->dropForign(['lansia_id']);
        });
    }
}
