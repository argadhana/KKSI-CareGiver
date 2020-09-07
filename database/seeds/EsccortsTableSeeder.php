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
            'salary' => 'esccort1',
            'keahlian' => 'mencuci',
            'name' => 'okegays',
            'age' => 22,
            'address' => 'jalanmanaaja',
            'gender' => 'laki-laki',
            'phone' => 86282,
            'rating' => 4,
        ]);
    }
}
