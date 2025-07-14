<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->delete();
        DB::table('categories')->insert([
            [
                'id'     => 1,
                'name'   => 'Mua bán',
                'slug'   => Str::slug('Mua bán'),
                'icon'   => '<i class="fas fa-handshake"></i>',
                'status' => 1,
            ],
            [
                'id'     => 2,
                'name'   => 'Dự án',
                'slug'   => Str::slug('Dự án'),
                'icon'   => '<i class="fas fa-building"></i>',
                'status' => 1,
            ],
            [
                'id'     => 3,
                'name'   => 'Mẫu nhà đẹp',
                'slug'   => Str::slug('Mẫu nhà đẹp'),
                'icon'   => '<i class="fas fa-home"></i>',
                'status' => 1,
            ],
            [
                'id'     => 4,
                'name'   => 'Kinh nghiệm',
                'slug'   => Str::slug('Kinh nghiệm'),
                'icon'   => '<i class="fas fa-lightbulb"></i>',
                'status' => 1,
            ],
        ]);
    }
}
