<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'          => 'SRobb',
            'email'         => 'srobb@gmail.com',
            'phone'         => '01784448434',
            'occupation'    => 'Admin',
            'user_identity' => '1921414854',
            'dob'           => '1987-07-08',
            'gender'        => 'Male',
            'address'       => 'dhaka',
            'image'         => 'images/dp.jpg',
            'role'          => '1',
            'password'      => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name'          => 'Jawad',
            'email'         => 'jawad@gmail.com',
            'phone'         => '01622222222',
            'occupation'    => 'Employee',
            'user_identity' => '1921234477',
            'dob'           => '1982-06-04',
            'gender'        => 'Male',
            'address'       => 'dhaka',
            'image'         => 'images/dp.jpg',
            'password'      => Hash::make('password'),
            'role'          => '2',
        ]);

        DB::table('users')->insert([
            'name'          => 'Iqbal',
            'email'         => 'iqbal@gmail.com',
            'phone'         => '01722111111',
            'occupation'    => 'Employee',
            'user_identity' => '1901230742',
            'dob'           => '1990-03-14',
            'gender'        => 'Male',
            'address'       => 'dhaka',
            'image'         => 'images/dp.jpg',
            'password'      => Hash::make('password'),
            'role'          => '3',
        ]);

        DB::table('users')->insert([
            'name'          => 'Mr. User',
            'email'         => 'user@gmail.com',
            'phone'         => '0172111111',
            'occupation'    => 'Programmer',
            'user_identity' => '1901239300',
            'dob'           => '1991-06-24',
            'gender'        => 'Male',
            'address'       => 'dhaka',
            'image'         => 'images/customer/dp.jpg',
            'password'      => Hash::make('password'),
            'role'          => '4',
        ]);
    }
}
