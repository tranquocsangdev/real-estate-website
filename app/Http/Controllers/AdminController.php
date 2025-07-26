<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getDataAdmin()
    {
        $data = Admin::orderByDESC('id')->get();

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
        Admin::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'avatar'    => $request->avatar,
        ]);

        return response()->json([
            'status'         => true,
            'message'        => 'Đã tạo mới tài khoản admin thành công',
        ]);
    }

    public function updateAdmin(Request $request)
    {
        $admin = Admin::find($request->id);

        if ($admin) {
            $admin->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'avatar'    => $request->avatar,
            ]);

            return response()->json([
                'status'         => true,
                'message'        => 'Đã cập nhật tài khoản admin thành công',
            ]);
        }
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
}
