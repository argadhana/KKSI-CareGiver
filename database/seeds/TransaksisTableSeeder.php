<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TransaksisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaksis')->insert([
            'order_time' => Carbon::now(),
            'paker' => 'harian',
            'durasi' => 2,
            'alamat' => 'jalan pandanaran',
            'nomor_telp' => '08964597534',
            'deskripsi_kerja' => 'Membacakan buku',
            'total_bayar' => '300000',
            'status' => 'belum',
            'user_id' => 5,
            'esccort_id' => 1,
            'lanisa_id' => 1,
        ]);
    }
}
