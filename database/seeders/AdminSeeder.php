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
                'name'      => 'Trần Quốc Sang',
                'email'     => 'tranquocsang@gmail.com',
                'password'  => bcrypt('123456'),
                'is_open'   => 1,
                'avatar'    => 'https://randomuser.me/api/portraits/men/1.jpg',
            ],
            [
                'id'        => 2,
                'name'      => 'Nguyễn Thị Thùy Dung',
                'email'     => 'nguyenthithuy@gmail.com',
                'password'  => bcrypt('123456'),
                'is_open'   => 1,
                'avatar'    => 'https://randomuser.me/api/portraits/men/2.jpg',
            ],
            [
                'id'        => 3,
                'name'      => 'Nguyen Van A',
                'email'     => 'nguyenvana@gmail.com',
                'password'  => bcrypt('123456'),
                'is_open'   => 1,
                'avatar'    => 'https://randomuser.me/api/portraits/men/3.jpg',
            ],
            [
                'id'        => 4,
                'name'      => 'Tran Thi B',
                'email'     => 'tranthib@gmail.com',
                'password'  => bcrypt('123456'),
                'is_open'   => 1,
                'avatar'    => 'https://randomuser.me/api/portraits/women/4.jpg',
            ],
        ]);
    }
}
