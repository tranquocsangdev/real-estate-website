<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Message;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function getDataAdmin()
    {
        $data = Admin::orderByDESC('id')->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function getDataAdminChat()
    {
        $user = Auth::guard('admin')->user();
        $data = Admin::where('is_open', 1)
            ->orderByDESC('id')
            ->where('id', '!=', $user->id)
            ->get()
            ->map(function ($admin) use ($user) {
                $admin->unread_count = Message::where('from_id', $admin->id)
                    ->where('to_id', $user->id)
                    ->where('is_read', 0)
                    ->count();

                $lastMessage = Message::where(function ($q) use ($user, $admin) {
                        $q->where('from_id', $admin->id)->where('to_id', $user->id);
                    })
                    ->orWhere(function ($q) use ($user, $admin) {
                        $q->where('from_id', $user->id)->where('to_id', $admin->id);
                    })
                    ->orderBy('id', 'desc')
                    ->first();

                $admin->last_message = optional($lastMessage)->message;
                $admin->last_message_at = optional(optional($lastMessage)->created_at)->toDateTimeString();
                $admin->last_message_from_id = optional($lastMessage)->from_id;
                return $admin;
            })->values();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function uploadAvatar(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/Avatar_Admin'), $fileName);
            return response()->json([
                'status'    => true,
                'file'      => '/uploads/Avatar_Admin/' . $fileName,
                'messages'  => 'Đã tải lên hình ảnh thành công!'
            ]);
        }
        return response()->json([
            'status'    => false,
        ]);
    }

    public function createAdmin(Request $request)
    {
        DB::transaction(function () use ($request) {
            Admin::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'avatar'    => $request->avatar,
            ]);
        });

        return response()->json([
            'status'         => true,
            'message'        => 'Đã tạo mới tài khoản admin thành công',
        ]);
    }

    public function updateAdmin(Request $request)
    {
        $admin = Admin::find($request->id);

        if (!$admin) {
            return response()->json([
                'status'  => false,
                'message' => 'Không tìm thấy tài khoản admin',
            ]);
        }

        DB::transaction(function () use ($request, $admin) {
            $admin->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'avatar'    => $request->avatar,
            ]);
        });

        return response()->json([
            'status'  => true,
            'message' => 'Đã cập nhật tài khoản admin thành công',
        ]);
    }

    public function deleteAdmin(Request $request)
    {
        $admin = Admin::find($request->id);

        if ($admin) {
            $admin->delete();
            return response()->json([
                'status'    => true,
                'message' => 'Đã xóa tài khoản admin thành công',
            ]);
        }

        return response()->json([
            'status'    => false,
            'message' => 'Tài khoản admin không tồn tại',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $admin = Admin::find($request->id);
        $admin->is_open = !$admin->is_open;
        $admin->save();

        $message = $admin->is_open
            ? 'Tình trạng đã đổi thành: <b>Đang hoạt động</b>'
            : 'Tình trạng đã đổi thành: <b>Đã khóa</b>';

        return response()->json([
            'status'         => true,
            'message'        => $message,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $data = $request->all();

        DB::transaction(function () use (&$data) {
            $admin = Admin::find($data['id']);

            if (!$data['avatar'] ?? null) {
                $data['avatar'] = $admin->avatar;
            }

            $admin->update($data);
        });

        Toastr::success("Cập nhật thành công!", 'Thành Công!');
        return redirect('/admin/profile');
    }
}
