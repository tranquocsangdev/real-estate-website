<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreateRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
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
        $data = Post::orderByDESC('id')->get();

        // Chuyển đổi images từ JSON string sang array
        foreach ($data as $post) {
            $post->images = json_decode($post->images ?? '[]', true);
        }

        return response()->json([
            'data'    => $data,
        ]);
    }

    public function createPost(CreateRequest $request)
    {
        Post::create([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'content'       => $request->content,
            'id_client'     => $request->id_client,
            'id_category'   => $request->id_category,
            'id_subcategory' => $request->id_subcategory,
            'thumbnail'     => $request->thumbnail,
            'price'         => $request->price,
            'area'          => $request->area,
            'bedrooms'      => $request->bedrooms,
            'bathrooms'     => $request->bathrooms,
            'location'      => $request->location,
            'address'       => $request->address,
            'project_name'  => $request->project_name,
            'phone'         => $request->phone,
            'zalo_link'     => $request->zalo_link,
            'map_link'      => $request->map_link,
            'images'        => json_encode($request->images)
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
                'status'    => false,
                'message'  => 'Bài viết không tồn tại!'
            ]);
        }

        $post->delete();

        return response()->json([
            'status'    => true,
            'message'  => 'Đã xóa bài viết thành công!'
        ]);
    }

    public function updatePost(Request $request)
    {
        $post = Post::find($request->id);
        if (!$post) {
            return response()->json([
                'status'    => false,
                'message'  => 'Bài viết không tồn tại!'
            ]);
        }

        $post->update([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'content'       => $request->content,
            'id_client'     => $request->id_client,
            'id_category'   => $request->id_category,
            'id_subcategory' => $request->id_subcategory,
            'thumbnail'     => $request->thumbnail,
            'price'         => $request->price,
            'area'          => $request->area,
            'bedrooms'      => $request->bedrooms,
            'bathrooms'     => $request->bathrooms,
            'location'      => $request->location,
            'address'       => $request->address,
            'project_name'  => $request->project_name,
            'phone'         => $request->phone,
            'zalo_link'     => $request->zalo_link,
            'map_link'      => $request->map_link,
            'images'        => json_encode($request->images)
        ]);

        return response()->json([
            'status'    => true,
            'message'  => 'Đã cập nhật bài viết thành công!'
        ]);
    }
}
