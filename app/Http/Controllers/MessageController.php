<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Events\MessageRead;
use App\Events\MessageSendEvent;
use App\Models\Admin;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function userAdmin()
    {
        $user = Auth::guard('admin')->user();

        $data = Admin::where('admins.is_open', 1)
                        ->where('admins.id', '!=', $user->id)
                        ->select('admins.id', 'admins.name', 'admins.avatar')
                        ->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function getDataConversation(Request $request)
    {
        $id_login = Auth::guard('admin')->user()->id;
        $id_user_dang_chon = $request->id;

        $data  = Message::where(function ($query) use ($id_login, $id_user_dang_chon) {
        $query->where('from_id', $id_login)
                ->where('to_id', $id_user_dang_chon);
                })->orWhere(function ($query) use ($id_login, $id_user_dang_chon) {
                    $query->where('from_id', $id_user_dang_chon)
                        ->where('to_id', $id_login);
                })
                ->join('admins as nguoi_gui', 'messages.from_id', 'nguoi_gui.id')
                ->join('admins as nguoi_nhan', 'messages.to_id', 'nguoi_nhan.id')
                ->select(
                    'messages.*',
                    'nguoi_nhan.name as ten_nguoi_gui',
                    'nguoi_gui.name as ten_nguoi_nhan',
                    'nguoi_nhan.avatar'
                )
                ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $message = Message::create([
            'to_id'     => $request->id,
            'from_id'   => $user->id,
            'message'   => $request->noi_dung,
        ]);
        broadcast(new MessageSendEvent($message))->toOthers();

    }

    /**
     * Gửi tin nhắn: from_id, to_id, message
     * Body JSON:
     * {
     *   "from_id": 1,
     *   "to_id": 2,
     *   "message": "Xin chào"
     * }
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $message = Message::create([
            'from_id' => $data['from_id'],
            'to_id'   => $data['to_id'],
            'message' => $data['message'],
            'is_read' => 0,
        ]);

        // Phát event realtime (đi qua queue nếu QUEUE_CONNECTION != sync)
        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'success' => true,
            'data'    => $message,
        ]);
    }

    /**
     * Lấy tất cả tin nhắn giữa 2 user (song phương)
     * GET /messages/{from}/{to}
     */
    public function between(int $from, int $to)
    {
        $messages = Message::where(function ($q) use ($from, $to) {
            $q->where('from_id', $from)->where('to_id', $to);
        })->orWhere(function ($q) use ($from, $to) {
            $q->where('from_id', $to)->where('to_id', $from);
        })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $messages,
        ]);
    }

    /**
     * Đánh dấu 1 tin là đã đọc
     * PATCH /messages/{id}/read
     */
    public function markAsRead(int $id)
    {
        $message = Message::findOrFail($id);
        $message->update(['is_read' => 1]);

        // Broadcast read receipt to others
        broadcast(new MessageRead([
            'type' => 'single',
            'id' => $message->id,
            'from_id' => $message->from_id,
            'to_id' => $message->to_id,
        ]))->toOthers();

        return response()->json([
            'success' => true,
            'data'    => $message,
        ]);
    }

    /**
     * Đánh dấu tất cả tin nhắn từ from -> to là đã đọc
     * PATCH /messages/read-between/{from}/{to}
     */
    public function markBetweenAsRead(int $from, int $to)
    {
        Message::where('from_id', $from)
            ->where('to_id', $to)
            ->where('is_read', 0)
            ->update(['is_read' => 1]);

        // Broadcast bulk read receipt
        broadcast(new MessageRead([
            'type' => 'bulk',
            'from_id' => $from,
            'to_id' => $to,
        ]))->toOthers();

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * (Tuỳ chọn) Lấy 50 tin gần nhất, không lọc
     * GET /messages
     */
    public function index()
    {
        $messages = Message::orderBy('id', 'desc')->limit(50)->get()->sortBy('id')->values();

        return response()->json([
            'success' => true,
            'data'    => $messages,
        ]);
    }
}
