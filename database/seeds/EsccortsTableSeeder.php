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
            'salary' => '2000000',
            'keahlian' => 'Care Giver',
            'name' => 'Bambang',
            'age' => 22,
            'address' => 'Kota Semarang',
            'gender' => 'L',
            'phone' => '086542147564',
            'user_id' => 3,
        ]);

        DB::table('esccorts')->insert([
            'salary' => '2000000',
            'keahlian' => 'Care Giver',
            'name' => 'Tuti',
            'age' => 22,
            'address' => 'Kota Semarang',
            'gender' => 'L',
            'phone' => '089513243243',
            'user_id' => 4,
        ]);
    }
}
