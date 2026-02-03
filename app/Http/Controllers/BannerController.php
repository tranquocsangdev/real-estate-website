<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    protected function deleteImageFile($imagePath)
    {
        if (!$imagePath) return;
        $fullPath = public_path($imagePath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    public function getDataBanner()
    {
        $data = Banner::orderBy('order')->get();

        return response()->json([
            'data' => $data,
        ]);
    }
    public function createBanner(Request $request)
    {
        if (Banner::count() >= 3) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn đã đạt số lượng banner tối đa',
            ]);
        }

       if(Banner::where('order', $request->order)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Thứ tự ' . $request->order . ' đã tồn tại',
            ]);
       }

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/Banner'), $fileName);

        try {
            DB::transaction(function () use ($fileName, $request) {
                Banner::create([
                    'image'  => '/uploads/Banner/' . $fileName,
                    'order'  => $request->order,
                    'status' => 1,
                ]);
            });

            return response()->json([
                'status' => true,
                'message' => 'Đã thêm mới banner thành công',
            ]);

        } catch (\Exception $e) {
            if (file_exists(public_path('uploads/Banner/' . $fileName))) {
                unlink(public_path('uploads/Banner/' . $fileName));
            }
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra, vui lòng thử lại!',
            ]);
        }
    }

    public function deleteBanner(Request $request)
    {
        $banner = Banner::find($request->id);
        $this->deleteImageFile($banner->image);
        DB::transaction(function () use ($banner) {
            $banner->delete();
        });
        return response()->json([
            'status' => true,
            'message' => 'Đã xóa banner thành công',
        ]);
    }

    public function changeStatusBanner(Request $request)
    {
        $banner = Banner::find($request->id);
        $banner->status = !$banner->status;
        $banner->save();

        $message = $banner->status
            ? 'Tình trạng đã đổi thành: <b>Đang hoạt động</b>'
            : 'Tình trạng đã đổi thành: <b>Đã ẩn hiện</b>';

        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }

}
