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
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function getBlogAdmin(Request $request)
    {
        $blog = Blog::find($request->id);
        if (!$blog) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy tin tức!',
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $blog,
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

    public function updateBlog(Request $request)
    {
        $blog = Blog::find($request->id);
        if (!$blog) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy tin tức!',
            ]);
        }

        $oldThumbnail = $blog->thumbnail;
        $newThumbnailPath = null;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/Blog'), $fileName);
            $newThumbnailPath = '/uploads/Blog/' . $fileName;
        }

        try {
            DB::transaction(function () use ($blog, $request, $newThumbnailPath, $oldThumbnail) {
                $blog->title = $request->title;
                $blog->slug = Str::slug($request->title);
                $blog->content = $request->content;
                if ($newThumbnailPath) {
                    $blog->thumbnail = $newThumbnailPath;
                }
                $blog->save();

                if ($newThumbnailPath && $oldThumbnail) {
                    $this->deleteImageFile($oldThumbnail);
                }
            });

            return response()->json([
                'status' => true,
                'message' => 'Đã cập nhật tin tức thành công!',
            ]);
        } catch (\Exception $e) {
            if ($newThumbnailPath) {
                $this->deleteImageFile($newThumbnailPath);
            }
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra, vui lòng thử lại!',
            ]);
        }
    }

    public function deleteBlog(Request $request)
    {
        $blog = Blog::find($request->id);
        if (!$blog) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy tin tức!',
            ]);
        }

        try {
            $thumbnail = $blog->thumbnail;
            $blog->delete();
            $this->deleteImageFile($thumbnail);

            return response()->json([
                'status' => true,
                'message' => 'Đã xóa tin tức thành công!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra, vui lòng thử lại!',
            ]);
        }
    }
}
