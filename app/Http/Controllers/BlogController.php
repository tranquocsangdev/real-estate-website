<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    protected function deleteImageFile($imagePath)
    {
        if (!$imagePath) return;
        $fullPath = public_path($imagePath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    public function getDataBlog()
    {
        $data = Blog::query()
            ->where('status', 1)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function createBlog(Request $request)
    {
        if (!$request->hasFile('thumbnail')) {
            return response()->json([
                'status' => false,
                'message' => 'Vui lòng chọn ảnh đại diện!',
            ]);
        }

        $file = $request->file('thumbnail');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/Blog'), $fileName);

        try {
            DB::transaction(function () use ($fileName, $request) {
                Blog::create([
                    'title'     => $request->title,
                    'slug'      => Str::slug($request->title),
                    'content'   => $request->content,
                    'thumbnail' => '/uploads/Blog/' . $fileName,
                ]);
            });

            return response()->json([
                'status' => true,
                'message' => 'Đã thêm mới tin tức thành công!',
            ]);

        } catch (\Exception $e) {
            if (file_exists(public_path('uploads/Blog/' . $fileName))) {
                unlink(public_path('uploads/Blog/' . $fileName));
            }
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra, vui lòng thử lại!',
            ]);
        }
    }
}
