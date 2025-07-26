<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->delete();
        DB::table('admins')->insert([
            [
                'id'        => 1,
                'name'      => 'Admin Master',
                'email'     => 'admin@master.com',
                'password'  => bcrypt('123456'),
                'is_open'   => 1,
                'avatar'    => 'https://randomuser.me/api/portraits/men/1.jpg',
            ],
            [
                'id'        => 2,
                'name'      => 'Admin Master 2',
                'email'     => 'admin2@master.com',
                'password'  => bcrypt('123456'),
                'is_open'   => 1,
                'avatar'    => 'https://randomuser.me/api/portraits/men/2.jpg',
            ],
        ]);
    }
}
