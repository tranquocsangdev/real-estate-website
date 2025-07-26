<?php

namespace App\Http\Controllers;

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
                'messages'  => 'Đã tải lên hình ảnh thành công!'
            ]);
        }
        return response()->json([
            'status'    => false,
        ]);
    }

    public function createPost(Request $request)
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
            'messages'  => 'Đã tạo bài viết thành công!'
        ]);
    }
}
