<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('order_time')->useCurrent();
            $table->dateTime('complate_time')->nullable();
            $table->string('paket')->nullable();
            $table->string('durasi')->nullable();
            $table->text('alamat')->nullable();
            $table->string('nomor_telp')->nullable();
            $table->text('deskripsi_kerja')->nullable();
            $table->string('total_bayar')->nullable();
            $table->string('status')->nullable();
            $table->text('payment')->nullable();
            $table->string('bukti_foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
