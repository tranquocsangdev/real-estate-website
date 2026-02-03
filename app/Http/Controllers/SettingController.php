<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    /**
     * Cập nhật settings. Sau khi lưu sẽ xóa cache để thay đổi có hiệu lực ngay.
     */
    public function update(Request $request)
    {
        $validKeys = Setting::pluck('key')->toArray();
        $inputs = $request->only($validKeys);
        foreach ($inputs as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value ?? '']);
        }
        Cache::forget('settings');
        return response()->json(['success' => true, 'message' => 'Đã lưu cài đặt. Thay đổi có hiệu lực ngay.']);
    }
}
