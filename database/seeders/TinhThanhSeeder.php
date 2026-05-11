<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TinhThanhSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tinh_thanhs')->truncate();

        DB::table('tinh_thanhs')->insert([
            [
                'code'                 => '01',
                'name'                 => 'Thành phố Hà Nội',
                'english_name'         => '',
                'administrative_level' => 'Thành phố Trung ương',
                'decree'               => '',
            ],
            [
                'code'                 => '04',
                'name'                 => 'Tỉnh Cao Bằng',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '',
            ],
            [
                'code'                 => '08',
                'name'                 => 'Tỉnh Tuyên Quang',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '11',
                'name'                 => 'Tỉnh Điện Biên',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '12',
                'name'                 => 'Tỉnh Lai Châu',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '14',
                'name'                 => 'Tỉnh Sơn La',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '15',
                'name'                 => 'Tỉnh Lào Cai',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '',
            ],
            [
                'code'                 => '19',
                'name'                 => 'Tỉnh Thái Nguyên',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '20',
                'name'                 => 'Tỉnh Lạng Sơn',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '22',
                'name'                 => 'Tỉnh Quảng Ninh',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '24',
                'name'                 => 'Tỉnh Bắc Ninh',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '',
            ],
            [
                'code'                 => '25',
                'name'                 => 'Tỉnh Phú Thọ',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '31',
                'name'                 => 'Thành phố Hải Phòng',
                'english_name'         => '',
                'administrative_level' => 'Thành phố Trung ương',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '33',
                'name'                 => 'Tỉnh Hưng Yên',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '37',
                'name'                 => 'Tỉnh Ninh Bình',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '38',
                'name'                 => 'Tỉnh Thanh Hóa',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '40',
                'name'                 => 'Tỉnh Nghệ An',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '42',
                'name'                 => 'Tỉnh Hà Tĩnh',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '44',
                'name'                 => 'Tỉnh Quảng Trị',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '',
            ],
            [
                'code'                 => '46',
                'name'                 => 'Thành phố Huế',
                'english_name'         => '',
                'administrative_level' => 'Thành phố Trung ương',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '48',
                'name'                 => 'Thành phố Đà Nẵng',
                'english_name'         => '',
                'administrative_level' => 'Thành phố Trung ương',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '51',
                'name'                 => 'Tỉnh Quảng Ngãi',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '52',
                'name'                 => 'Tỉnh Gia Lai',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '',
            ],
            [
                'code'                 => '56',
                'name'                 => 'Tỉnh Khánh Hòa',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '66',
                'name'                 => 'Tỉnh Đắk Lắk',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '68',
                'name'                 => 'Tỉnh Lâm Đồng',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '75',
                'name'                 => 'Tỉnh Đồng Nai',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '79',
                'name'                 => 'Thành phố Hồ Chí Minh',
                'english_name'         => '',
                'administrative_level' => 'Thành phố Trung ương',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '80',
                'name'                 => 'Tỉnh Tây Ninh',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '',
            ],
            [
                'code'                 => '82',
                'name'                 => 'Tỉnh Đồng Tháp',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '',
            ],
            [
                'code'                 => '86',
                'name'                 => 'Tỉnh Vĩnh Long',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '91',
                'name'                 => 'Tỉnh An Giang',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '',
            ],
            [
                'code'                 => '92',
                'name'                 => 'Thành phố Cần Thơ',
                'english_name'         => '',
                'administrative_level' => 'Thành phố Trung ương',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
            [
                'code'                 => '96',
                'name'                 => 'Tỉnh Cà Mau',
                'english_name'         => '',
                'administrative_level' => 'Tỉnh',
                'decree'               => '202/2025/QH15 - 12/06/2025',
            ],
        ]);
    }
}
