<?php

namespace App\Http\Controllers;

use App\Events\AdminNotificationEvent;
use App\Models\KhachHang;
use App\Models\Notification;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KhachHangController extends Controller
{
    public function actionRegister(Request $request)
    {
        DB::transaction(function () use ($request) {
            $khach_hang = KhachHang::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'password'  => bcrypt($request->password),
            ]);

            $notification = Notification::create([
                'type'          => Notification::KHACH_HANG_REGISTER,
                'tieu_de'       => $khach_hang->name,
                'noi_dung'      => 'Vừa đăng ký tài khoản mới',
            ]);

            event(new AdminNotificationEvent($notification));

        });
        Toastr::success('Đăng ký thành công! Vui lòng đăng nhập để tiếp tục', 'Success');
        return redirect('/user/login');
    }

    public function actionLogin(Request $request)
    {
        $check_tk = KhachHang::where('email', $request->login)
                            ->orWhere('phone', $request->login)
                            ->first();

        if (!$check_tk) {
            Toastr::error("Email hoặc số điện thoại không tồn tại trong hệ thống!", 'Error!');
            return redirect()->back();
        }
        $check_email  = Auth::guard('khach_hangs')->attempt([
            'email'     => $check_tk->email,
            'password'  => $request->password,
        ]);
        $check_phone  = Auth::guard('khach_hangs')->attempt([
            'phone'     => $check_tk->phone,
            'password'  => $request->password,
        ]);

        if ($check_email || $check_phone) {
            $user = Auth::guard('khach_hangs')->user();

            if ($user->is_active == 1) {
                Toastr::success("Đăng nhập thành công!", 'Success!');
                return redirect('/');
            } else {
                Toastr::error("Tài khoản đã bị khoá!", 'Error!');
                Auth::guard('khach_hangs')->logout();
                return redirect()->back();
            }
        } else {
            Toastr::error("Email hoặc số điện thoại không chính xác!", 'Error!');
            return redirect()->back();
        }
    }

    public function actionLogout()
    {
        Auth::guard('khach_hangs')->logout();
        Toastr::success("Bạn đã đăng xuất thành công!", 'Success!');
        return redirect('/user/login');
    }

    public function getDataUser()
    {
        $data = KhachHang::orderByDESC('id')
                        ->select('id', 'name', 'email', 'phone', 'is_active')
                        ->get();
        return response()->json([
            'data' => $data,
        ]);
    }

    public function deleteUser(Request $request)
    {
        $user = KhachHang::where('id', $request->id)->first();
        if ($user) {
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'Đã xóa tài khoản khách hàng thành công',
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Tài khoản khách hàng không tồn tại',
        ]);
    }

    public function changeStatusUser(Request $request)
    {
        $user = KhachHang::where('id', $request->id)->first();

        if($user->is_active == 1) {
            $user->is_active = 0;
            $user->save();
            $message = 'Đã đổi trạng thái thành: <b>Đã khóa</b>';
            Auth::guard('khach_hangs')->logout();
        } else {
            $user->is_active = 1;
            $user->save();
            $message = 'Đã đổi trạng thái thành: <b>Đang hoạt động</b>';
        }

        return response()->json([
            'status'  => true,
            'message' => $message,
        ]);
    }
}
