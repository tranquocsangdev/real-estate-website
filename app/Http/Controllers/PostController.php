<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreateRequest;
use App\Models\Post;
use App\Models\TinhThanh;
use App\Models\XaPhuong;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected function deleteImageFile($imagePath)
    {
        if (!$imagePath) return;
        $fullPath = public_path($imagePath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    public function uploadPostImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/Post'), $fileName);
            return response()->json([
                'status'    => true,
                'file'      => '/uploads/Post/' . $fileName,
                'message'  => 'Đã tải lên hình ảnh thành công!'
            ]);
        }
        return response()->json([
            'status'    => false,
        ]);
    }

    public function getDataPost()
    {
        $data = Post::join('categories', 'posts.id_category', 'categories.id')
                    ->join('subcategories', 'posts.id_subcategory', 'subcategories.id')
                    ->join('tinh_thanhs', 'tinh_thanhs.id', 'posts.id_tinh_thanh')
                    ->join('xa_phuongs', 'xa_phuongs.id', 'posts.id_xa_phuong')
                    ->select(
                        'posts.*',
                        'categories.name as name_category',
                        'subcategories.name as name_subcategory',
                        'tinh_thanhs.name as ten_tinh_thanh',
                        'xa_phuongs.name as ten_xa_phuong',
                    )
                    ->orderByDESC('posts.created_at')
                    ->paginate(5);

        foreach ($data as $v) {

            $v->images = json_decode($v->images, true);
        }

        return response()->json([
            'data' => $data,
        ]);
    }

    public function getContactSuggestions()
    {
        $posts = Post::query()
            ->whereNotNull('phone')
            ->whereRaw("TRIM(phone) <> ''")
            ->orderByDesc('id')
            ->limit(500)
            ->get(['id', 'phone', 'zalo_link']);

        $byDigits = [];
        foreach ($posts as $post) {
            $digits = preg_replace('/\D/u', '', (string) $post->phone);
            if (strlen($digits) < 9) {
                continue;
            }
            if (!isset($byDigits[$digits])) {
                $zalo = $post->zalo_link !== null && trim((string) $post->zalo_link) !== ''
                    ? trim((string) $post->zalo_link)
                    : null;
                $byDigits[$digits] = [
                    'phone'       => trim((string) $post->phone),
                    'zalo_link'   => $zalo,
                    'posts_count' => 0,
                ];
            }
            $byDigits[$digits]['posts_count']++;
        }

        $data = collect($byDigits)
            ->sortByDesc(fn ($row) => $row['posts_count'])
            ->values()
            ->take(20)
            ->values();

        return response()->json([
            'status' => true,
            'data'   => $data,
        ]);
    }

    public function getPostDetail(Request $request)
    {
        $post = Post::join('tinh_thanhs', 'tinh_thanhs.id', 'posts.id_tinh_thanh')
                    ->join('xa_phuongs', 'xa_phuongs.id', 'posts.id_xa_phuong')
                    ->select(
                        'posts.*',
                        'tinh_thanhs.name as ten_tinh_thanh',
                        'xa_phuongs.name as ten_xa_phuong',
                    )
                    ->where('posts.id', $request->id)
                    ->first();
        if ($post) {
            $post->images = json_decode($post->images, true) ?? [];
        }

        return response()->json([
            'status' => true,
            'data'   => $post,
        ]);
    }

    public function createPost(CreateRequest $request)
    {
        Post::create([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'content'       => $request->content,
            'id_category'   => $request->id_category,
            'id_subcategory'=> $request->id_subcategory,
            'id_tinh_thanh' => $request->id_tinh_thanh,
            'id_xa_phuong'  => $request->id_xa_phuong,
            'thumbnail'     => $request->thumbnail,
            'price'         => $request->price,
            'area'          => $request->area,
            'bedrooms'      => $request->bedrooms,
            'bathrooms'     => $request->bathrooms,
            'address'       => $request->address,
            'project_name'  => $request->project_name,
            'phone'         => $request->phone,
            'zalo_link'     => $request->zalo_link,
            'map_link'      => $request->map_link,
            'images'        => json_encode($request->images ?? []),
        ]);

        return response()->json([
            'status'    => true,
            'message'  => 'Đã tạo bài viết thành công!'
        ]);
    }

    public function deletePost(Request $request)
    {
        $post = Post::find($request->id);

        if (!$post) {
            return response()->json([
                'status'  => false,
                'message' => 'Bài viết không tồn tại!'
            ]);
        }

        // Xóa thumbnail
        if ($post->thumbnail) {
            $this->deleteImageFile($post->thumbnail);
        }

        // Decode images JSON
        $images = json_decode($post->images ?? '[]', true);

        if (!empty($images)) {
            foreach ($images as $image) {
                $this->deleteImageFile($image);
            }
        }

        $post->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Đã xóa bài viết thành công!'
        ]);
    }


    public function updatePost(Request $request)
    {
        $request->validate([
            'id'              => ['required', 'integer'],
            'title'           => ['required'],
            'content'         => ['required'],
            'id_category'     => ['required'],
            'id_subcategory'  => ['required'],
            'id_tinh_thanh'   => ['required', 'integer', 'exists:tinh_thanhs,id'],
            'id_xa_phuong'    => ['required', 'integer', 'exists:xa_phuongs,id'],
            'thumbnail'       => ['required'],
            'price'           => ['required'],
            'area'            => ['required'],
            'address'         => ['required'],
            'phone'           => ['required'],
            'zalo_link'       => ['required'],
            'map_link'        => ['required'],
        ]);

        $post = Post::find($request->id);
        if (!$post) {
            return response()->json([
                'status'    => false,
                'message'  => 'Bài viết không tồn tại!'
            ]);
        }

        $oldThumbnail = $post->thumbnail;
        $oldImages = json_decode($post->images ?? '[]', true) ?: [];
        $newImages = $request->images ?? [];
        if (!is_array($newImages)) $newImages = [];

        // Nếu đổi thumbnail thì xóa thumbnail cũ
        if ($oldThumbnail && $request->thumbnail && $oldThumbnail !== $request->thumbnail) {
            $this->deleteImageFile($oldThumbnail);
        }

        // Xóa các ảnh detail bị bỏ đi khi update
        $removed = array_diff($oldImages, $newImages);
        foreach ($removed as $img) {
            $this->deleteImageFile($img);
        }

        $post->update([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'content'       => $request->content,
            'id_client'     => $request->id_client,
            'id_category'   => $request->id_category,
            'id_subcategory' => $request->id_subcategory,
            'id_tinh_thanh' => (int) $request->id_tinh_thanh,
            'id_xa_phuong'  => (int) $request->id_xa_phuong,
            'thumbnail'     => $request->thumbnail,
            'price'         => $request->price,
            'area'          => $request->area,
            'bedrooms'      => $request->bedrooms,
            'bathrooms'     => $request->bathrooms,
            'address'       => $request->address,
            'project_name'  => $request->project_name,
            'phone'         => $request->phone,
            'zalo_link'     => $request->zalo_link,
            'map_link'      => $request->map_link,
            'images'        => json_encode($newImages),
        ]);

        return response()->json([
            'status'    => true,
            'message'  => 'Đã cập nhật bài viết thành công!'
        ]);
    }

    public function changePost(Request $request)
    {
        $post = Post::where('id', $request->id)->first();
        $post->status = !$post->status;
        $post->save();

        $message = $post->status
            ? 'Tình trạng đã đổi thành: <b>Hoạt động</b>'
            : 'Tình trạng đã đổi thành: <b>Tạm tắt</b>';

        return response()->json([
            'status'         => true,
            'message'        => $message,
        ]);
    }
}
