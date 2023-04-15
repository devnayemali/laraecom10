<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRecords = [
            'id' => 1,
            'vendor_id' => '1',
            'role' => 1,
            'name' => 'admin',
            'mobile' => '+08801721216515',
            'image' => 'imagename',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('11111111'),
            'status' => 1,
        ];

        DB::table('users')->insert($userRecords);

    }
}
