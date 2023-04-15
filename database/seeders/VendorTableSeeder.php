<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRecords = [
            'id' => 1,
            'name' => 'Nayem Ali',
            'address' => 'Boalia, Gomastapur, Chaipainobabgong',
            'city' => 'Chaipainobabgong',
            'state' => 'Rajshahi',
            'country' => 'Bangladesh',
            'pincode' => '1111',
            'mobile' => '+08801721216516',
            'email' => 'nayemali12019@gmail.com',
            'status' => 1,
        ];

        DB::table('vendors')->insert($userRecords);
    }
}
