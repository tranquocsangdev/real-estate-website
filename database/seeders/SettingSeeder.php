<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('settings')->delete();
        DB::table('settings')->truncate();
        DB::table('settings')->insert([
            [
                'key' => 'phone',
                'value' => '039 441 0447',
                'type' => 'number',
                'group' => 'info',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'site_name',
                'value' => 'Thùy Dung BDS - Bất động sản',
                'type' => 'text',
                'group' => 'info',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'address',
                'value' => 'Phường Hòa Xuân, Thành Phố Đà Nẵng',
                'type' => 'text',
                'group' => 'info',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'working_time',
                'value' => '8:00 - 21:00',
                'type' => 'time',
                'group' => 'info',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'email',
                'value' => 'thuydungbds@gmail.com',
                'type' => 'email',
                'group' => 'contact',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'facebook',
                'value' => 'https://www.facebook.com/thuydung.bdsdn',
                'type' => 'url',
                'group' => 'social',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'zalo',
                'value' => '039 441 0447',
                'type' => 'phone',
                'group' => 'social',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'gmail',
                'value' => 'thuydungbds@gmail.com',
                'type' => 'email',
                'group' => 'social',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'meta_title',
                'value' => 'Thùy Dung BDS - Bất động sản',
                'type' => 'text',
                'group' => 'seo',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'meta_description',
                'value' => 'Thùy Dung BDS - Bất động sản',
                'type' => 'textarea',
                'group' => 'seo',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'Thùy Dung BDS, Bất động sản, Đà Nẵng',
                'type' => 'text',
                'group' => 'seo',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'logo',
                'value' => 'https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png',
                'type' => 'image',
                'group' => 'system',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'favicon',
                'value' => 'https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png',
                'type' => 'image',
                'group' => 'system',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
