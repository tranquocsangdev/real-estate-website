<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use Carbon\Carbon;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        // Xóa dữ liệu cũ
        DB::table('messages')->truncate();

        // Lấy danh sách user id (theo AdminSeeder đã tạo từ 1 -> 12)
        $userIds = range(1, 12);

        // Mảng câu tin nhắn có sẵn
        $messageContents = [
            "Chào bạn, hôm nay thế nào rồi?",
            "Mình đang làm dự án Laravel, hơi đau đầu.",
            "Bạn có rảnh chiều nay không?",
            "Trưa nay ăn gì ngon vậy?",
            "Hôm qua xem phim gì chưa?",
            "Bạn có thích đi cà phê không?",
            "Mai có lịch họp nhóm nhé.",
            "Làm xong bài tập chưa đó?",
            "Nghe nói bạn mới mua máy mới hả?",
            "Thời tiết hôm nay mát quá nhỉ.",
            "Tối nay có đi đá bóng không?",
            "Bạn có chơi game Liên Quân không?",
            "Mình cần giúp fix bug Vue.js.",
            "Sếp vừa gửi mail kìa.",
            "Bạn ơi share tài liệu với.",
            "Đi nhậu không bạn ơi 🍻",
            "Trời mưa làm lười ghê.",
            "Có ai muốn đi xem ca nhạc không?",
            "Đi xem đá banh chung không?",
            "Bạn đang code cái gì đó?",
            "Mạng lag quá chịu không nổi.",
            "Deadline dí tới nơi rồi.",
            "Bạn ăn sáng chưa?",
            "Đi ngủ chưa khuya rồi đó.",
            "Check giúp mình tin nhắn kia nhé.",
            "Trưa nay đi ăn phở không?",
            "Đi biển Vũng Tàu cuối tuần nhé.",
            "Cà phê sữa hay cà phê đen?",
            "Bạn share link zoom đi.",
            "Mình đang học tiếng Anh nè.",
            "Bạn có online không vậy?",
            "Ngủ chưa hay còn thức?",
            "Làm tới đâu rồi bạn ơi?",
            "Mình bị lỗi database nè.",
            "Đi chơi lễ này không?",
            "Mới nhận lương vui quá.",
            "Bạn có thích nuôi mèo không?",
            "Đi uống trà sữa chung không?",
            "Đi siêu thị cuối tuần đi.",
            "Ngồi cà phê làm việc cho vui.",
            "Mình thích xem phim kinh dị.",
            "Đi coi kịch không bạn?",
            "Tối nay chơi game nhé.",
            "Ngủ đủ giấc mới khỏe.",
            "Đi phượt không bạn?",
            "Mình thích ăn hải sản.",
            "Bạn có thích đồ ngọt không?",
            "Mới ra mắt điện thoại mới nè.",
            "Bạn có đi học thêm không?",
            "Đi shopping không bạn?",
            "Coi bóng đá trực tiếp đi.",
            "Bạn đang ở đâu vậy?",
            "Đi du lịch nước ngoài chưa?",
            "Mới cài app mới nè.",
            "Đi uống bia hơi không?",
            "Đang code xuyên đêm luôn.",
            "Ngồi cà phê tám chuyện cho vui.",
            "Đi ăn lẩu không bạn?",
            "Mình đang chỉnh sửa giao diện.",
            "Đi xem pháo hoa đi.",
        ];

        $insertData = [];

        // Tạo 100 tin nhắn
        for ($i = 0; $i < 100; $i++) {
            $from = $userIds[array_rand($userIds)];
            $to   = $userIds[array_rand($userIds)];

            // đảm bảo không tự gửi cho chính mình
            while ($to === $from) {
                $to = $userIds[array_rand($userIds)];
            }

            $insertData[] = [
                'from_id'    => $from,
                'to_id'      => $to,
                'message'    => $messageContents[array_rand($messageContents)],
                'is_read'    => rand(0, 1),
                'created_at' => Carbon::now()->subMinutes(rand(0, 300)),
                'updated_at' => Carbon::now(),
            ];
        }

        // Insert vào DB
        Message::insert($insertData);
    }
}
