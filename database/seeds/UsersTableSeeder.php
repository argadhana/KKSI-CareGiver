<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin1',
            'email' => 'admin1@admin.com',
            'password' => 'password',
            'age' => 22,
            'address' => 'jalanmanaaja',
            'gender' => 'laki-laki',
            'phone' => 86282,
        ]);

        DB::table('users')->insert([
            'name' => 'admin2',
            'email' => 'admin2@admin.com',
            'password' => 'password',
            'age' => 22,
            'address' => 'jalanmanaaja',
            'gender' => 'laki-laki',
            'phone' => 86282,
        ]);

        DB::table('users')->insert([
            'name' => 'esccort',
            'email' => 'esccort@esccort.com',
            'password' => 'password',
            'age' => 12,
            'address' => 'jalanmaanaaja',
            'gender' => 'Perempuan',
            'phone' => 862822582,
        ]);

        DB::table('users')->insert([
            'name' => 'esccort1',
            'email' => 'esccort1@esccort.com',
            'password' => 'password',
            'age' => 42,
            'address' => 'jalanqmaanaaja',
            'gender' => 'Perempuan',
            'phone' => 8628222582,
        ]);

        DB::table('users')->insert([
            'name' => 'customer',
            'email' => 'customer@customer.com',
            'password' => 'password',
            'age' => 12,
            'address' => 'jalanmaanaaaja',
            'gender' => 'Perempuan',
            'phone' => 86282952582,
        ]);
    }
}