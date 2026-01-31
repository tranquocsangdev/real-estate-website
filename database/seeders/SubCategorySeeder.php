<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subcategories')->delete();
        DB::table('subcategories')->insert(
            [
                // --- Mua bán ---
                [
                    'id'            => 1,
                    'name'          => 'Nhà riêng',
                    'slug'          => Str::slug('Nhà riêng'),
                    'icon'          => '<i class="fas fa-home"></i>',
                    'id_category'   => 1,
                    'status'        => 1,
                ],
                [
                    'id'            => 2,
                    'name'          => 'Chung cư',
                    'slug'          => Str::slug('Chung cư'),
                    'icon'          => '<i class="fas fa-city"></i>',
                    'id_category'   => 1,
                    'status'        => 1,
                ],
                [
                    'id'            => 3,
                    'name'          => 'Đất nền',
                    'slug'          => Str::slug('Đất nền'),
                    'icon'          => '<i class="fas fa-map-marked-alt"></i>',
                    'id_category'   => 1,
                    'status'        => 1,
                ],
                [
                    'id'            => 4,
                    'name'          => 'Đất thổ cư',
                    'slug'          => Str::slug('Đất thổ cư'),
                    'icon'          => '<i class="fas fa-landmark"></i>',
                    'id_category'   => 1,
                    'status'        => 1,
                ],

                // --- Dự án ---
                [
                    'id'            => 5,
                    'name'          => 'Căn hộ cao cấp',
                    'slug'          => Str::slug('Căn hộ cao cấp'),
                    'icon'          => '<i class="fas fa-building"></i>',
                    'id_category'   => 2,
                    'status'        => 1,
                ],
                [
                    'id'            => 6,
                    'name'          => 'Khu đô thị mới',
                    'slug'          => Str::slug('Khu đô thị mới'),
                    'icon'          => '<i class="fas fa-city"></i>',
                    'id_category'   => 2,
                    'status'        => 1,
                ],

                // --- Mẫu nhà đẹp ---
                [
                    'id'            => 7,
                    'name'          => 'Nhà phố hiện đại',
                    'slug'          => Str::slug('Nhà phố hiện đại'),
                    'icon'          => '<i class="fas fa-home"></i>',
                    'id_category'   => 3,
                    'status'        => 1,
                ],
                [
                    'id'            => 8,
                    'name'          => 'Biệt thự sân vườn',
                    'slug'          => Str::slug('Biệt thự sân vườn'),
                    'icon'          => '<i class="fas fa-tree"></i>',
                    'id_category'   => 3,
                    'status'        => 1,
                ],

                // --- Kinh nghiệm ---
                [
                    'id'            => 9,
                    'name'          => 'Phong thủy nhà ở',
                    'slug'          => Str::slug('Phong thủy nhà ở'),
                    'icon'          => '<i class="fas fa-compass"></i>',
                    'id_category'   => 4,
                    'status'        => 1,
                ],
                [
                    'id'            => 10,
                    'name'          => 'Tư vấn pháp lý',
                    'slug'          => Str::slug('Tư vấn pháp lý'),
                    'icon'          => '<i class="fas fa-balance-scale"></i>',
                    'id_category'   => 4,
                    'status'        => 1,
                ],
            ]
        );
    }
}
