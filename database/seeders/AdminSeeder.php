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
            [
                'id'        => 5,
                'name'      => 'Le Van C',
                'email'     => 'levanc@gmail.com',
                'password'  => bcrypt('123456'),
                'is_open'   => 1,
                'avatar'    => 'https://randomuser.me/api/portraits/men/5.jpg',
            ],
            [
                'id'        => 6,
                'name'      => 'Pham Thi D',
                'email'     => 'phamthid@gmail.com',
                'password'  => bcrypt('123456'),
                'is_open'   => 1,
                'avatar'    => 'https://randomuser.me/api/portraits/women/6.jpg',
            ],
            [
                'id'        => 7,
                'name'      => 'Hoang Van E',
                'email'     => 'hoangvane@gmail.com',
                'password'  => bcrypt('123456'),
                'is_open'   => 1,
                'avatar'    => 'https://randomuser.me/api/portraits/men/7.jpg',
            ],
            [
                'id'        => 8,
                'name'      => 'Vu Thi F',
                'email'     => 'vuthif@gmail.com',
                'password'  => bcrypt('123456'),
                'is_open'   => 1,
                'avatar'    => 'https://randomuser.me/api/portraits/women/8.jpg',
            ],
            [
                'id'        => 9,
                'name'      => 'Dang Van G',
                'email'     => 'dangvang@gmail.com',
                'password'  => bcrypt('123456'),
                'is_open'   => 1,
                'avatar'    => 'https://randomuser.me/api/portraits/men/9.jpg',
            ],
            [
                'id'        => 10,
                'name'      => 'Ngo Thi H',
                'email'     => 'ngothih@gmail.com',
                'password'  => bcrypt('123456'),
                'is_open'   => 1,
                'avatar'    => 'https://randomuser.me/api/portraits/women/10.jpg',
            ],
            [
                'id'        => 11,
                'name'      => 'Bui Van I',
                'email'     => 'buivani@gmail.com',
                'password'  => bcrypt('123456'),
                'is_open'   => 1,
                'avatar'    => 'https://randomuser.me/api/portraits/men/11.jpg',
            ],
            [
                'id'        => 12,
                'name'      => 'Do Thi J',
                'email'     => 'dothij@gmail.com',
                'password'  => bcrypt('123456'),
                'is_open'   => 1,
                'avatar'    => 'https://randomuser.me/api/portraits/women/12.jpg',
            ],
        ]);
    }
}
