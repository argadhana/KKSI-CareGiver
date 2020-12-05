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
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'bcrypt("password")',
            'age' => 22,
            'address' => 'Kota Semarang',
            'gender' => 'L',
            'phone' => '089456756421',
        ]);

        DB::table('users')->insert([
            'name' => 'admin2',
            'email' => 'admin2@admin.com',
            'password' => 'bcrypt("password")',
            'age' => 22,
            'address' => 'Semarang',
            'gender' => 'L',
            'phone' => '089545667542',
        ]);

        DB::table('users')->insert([
            'name' => 'esccort',
            'email' => 'esccort@esccort.com',
            'password' => 'bcrypt("password")',
            'age' => 12,
            'address' => 'Kota Semarang',
            'gender' => 'P',
            'phone' => '08975465575',
        ]);

        DB::table('users')->insert([
            'name' => 'esccort1',
            'email' => 'esccort1@esccort.com',
            'password' => 'bcrypt("password")',
            'age' => 42,
            'address' => 'Kota Semarang',
            'gender' => 'P',
            'phone' => '089547547542',
        ]);

        DB::table('users')->insert([
            'name' => 'customer',
            'email' => 'customer@customer.com',
            'password' => 'bcrypt("password")',
            'age' => 12,
            'address' => 'Kota Semarang',
            'gender' => 'P',
            'phone' => '086282952582',
        ]);
    }
}