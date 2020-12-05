<?php

use Illuminate\Database\Seeder;

class LansiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lansias')->insert([
            'nama' => 'Sepuh',
            'umur' => 65,
            'gender' => 'P',
            'hobi' => 'membaca buku',
            'riwayat' => 'Penyakit jantung',
        ]);
    }
}
