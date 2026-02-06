<?php

namespace App\Http\Controllers;

use App\Events\AdminNotificationReadAllEvent;
use App\Events\AdminNotificationReadEvent;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function getDataNotification()
    {
        $data = Notification::orderByDESC('created_at')
                            ->limit(6)
                            ->get();

        $tong_thong_bao = Notification::where('is_read', 0)->count();

        return response()->json([
            'data'           => $data,
            'tong_thong_bao' => $tong_thong_bao,
        ]);
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)->first();
        $notification->update([
            'is_read' => 1,
        ]);

        event(new AdminNotificationReadEvent($notification->id));

        return response()->json([
            'status' => true,
        ]);
    }

    public function markAsReadAll()
    {
        Notification::where('is_read', 0)
        ->update([
            'is_read' => 1,
        ]);

        event(new AdminNotificationReadAllEvent());

        return response()->json([
            'status' => true,
        ]);
    }
}
