<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreateRequest;
use App\Models\Post;
use App\Models\TinhThanh;
use App\Models\XaPhuong;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected function buildLocationLabel(?int $idTinh, ?int $idXa): string
    {
        if (!$idTinh || !$idXa) {
            return '';
        }

        $xa = XaPhuong::query()->find($idXa);
        $tinh = TinhThanh::query()->find($idTinh);
        if (!$xa || !$tinh) {
            return '';
        }
        if ($xa->id_thuoc_tinh_thanh !== $tinh->code) {
            return '';
        }

        return trim($xa->name . ' — ' . $tinh->name);
    }

    protected function enrichPostLocation(Post $post): void
    {
        if ($post->relationLoaded('xaPhuong') && $post->relationLoaded('tinhThanh')
            && $post->xaPhuong && $post->tinhThanh) {
            $post->location = trim($post->xaPhuong->name . ' — ' . $post->tinhThanh->name);
        }
    }

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
        $page = (int) request()->input('page', 1);
        if ($page < 1) $page = 1;

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $q = trim((string) request()->input('q', ''));
        $numericQuery = preg_replace('/\D+/', '', $q);
        $idCategory = request()->input('id_category');
        $idSubcategory = request()->input('id_subcategory');

        $query = Post::query()
            ->with([
                'tinhThanh:id,code,name',
                'xaPhuong:id,name,id_thuoc_tinh_thanh',
            ])
            ->orderByDesc('id');

        if ($q !== '') {
            $query->where(function ($sub) use ($q, $numericQuery) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('address', 'like', "%{$q}%")
                    ->orWhere('location', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%")
                    ->orWhereRaw('CAST(price AS CHAR) LIKE ?', ["%{$q}%"])
                    ->orWhereRaw('CAST(area AS CHAR) LIKE ?', ["%{$q}%"])
                    ->orWhereHas('tinhThanh', function ($qry) use ($q) {
                        $qry->where('name', 'like', "%{$q}%");
                    })
                    ->orWhereHas('xaPhuong', function ($qry) use ($q) {
                        $qry->where('name', 'like', "%{$q}%");
                    });

                if ($numericQuery !== '') {
                    $sub->orWhereRaw('CAST(price AS CHAR) LIKE ?', ["%{$numericQuery}%"])
                        ->orWhereRaw('CAST(area AS CHAR) LIKE ?', ["%{$numericQuery}%"]);
                }
            });
        }

        if ($idCategory !== null && $idCategory !== '') {
            $query->where('id_category', $idCategory);
        }

        if ($idSubcategory !== null && $idSubcategory !== '') {
            $query->where('id_subcategory', $idSubcategory);
        }

        $paginator = $query->paginate(10);

        $items = $paginator->getCollection()->map(function ($post) {
            $post->images = json_decode($post->images ?? '[]', true);
            $this->enrichPostLocation($post);
            return $post;
        })->values();

        return response()->json([
            'data' => $items,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page'    => $paginator->lastPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
            ],
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
        $request->validate([
            'id' => ['required', 'integer'],
        ]);

        $post = Post::query()
            ->with([
                'tinhThanh:id,code,name',
                'xaPhuong:id,name,id_thuoc_tinh_thanh',
            ])
            ->find($request->id);
        if (!$post) {
            return response()->json([
                'status'  => false,
                'message' => 'Bài viết không tồn tại!',
            ], 404);
        }

        $post->images = json_decode($post->images ?? '[]', true);
        $this->enrichPostLocation($post);

        return response()->json([
            'status' => true,
            'data'   => $post,
        ]);
    }

    public function createPost(CreateRequest $request)
    {
        $idTinh = (int) $request->id_tinh_thanh;
        $idXa = (int) $request->id_xa_phuong;
        $locationLabel = $this->buildLocationLabel($idTinh, $idXa);

        Post::create([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'content'       => $request->content,
            'id_client'     => $request->id_client,
            'id_category'   => $request->id_category,
            'id_subcategory' => $request->id_subcategory,
            'id_tinh_thanh' => $idTinh,
            'id_xa_phuong'  => $idXa,
            'thumbnail'     => $request->thumbnail,
            'price'         => $request->price,
            'area'          => $request->area,
            'bedrooms'      => $request->bedrooms,
            'bathrooms'     => $request->bathrooms,
            'location'      => $locationLabel,
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
        $request->validate([
            'id' => ['required', 'integer'],
        ]);

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

        $tinh = TinhThanh::query()->find($request->id_tinh_thanh);
        $xa = XaPhuong::query()->find($request->id_xa_phuong);
        // if (!$xa || !$tinh || $xa->id_thuoc_tinh_thanh !== $tinh->code) {
        //     return response()->json([
        //         'status'    => false,
        //         'message'  => 'Xã/Phường không thuộc Tỉnh/Thành phố đã chọn.',
        //     ], 422);
        // }

        $locationLabel = $this->buildLocationLabel((int) $request->id_tinh_thanh, (int) $request->id_xa_phuong);

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
            'location'      => $locationLabel,
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
}
