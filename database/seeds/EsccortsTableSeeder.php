<?php

use Illuminate\Database\Seeder;

class EsccortsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('esccorts')->insert([
            'salary' => '40000',
            'keahlian' => 'mencuci',
            'name' => 'okegays',
            'age' => 22,
            'address' => 'jalanmanaaja',
            'gender' => 'laki-laki',
            'phone' => 86282,
            'rating' => 4,
        ]);

        DB::table('esccorts')->insert([
            'salary' => '40000',
            'keahlian' => 'memasak',
            'name' => 'kamuiyakamu',
            'age' => 18,
            'address' => 'pentingnyaman',
            'gender' => 'perempuan',
            'phone' => 869878282,
            'rating' => 4,
        ]);
    }
}
