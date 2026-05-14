<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\Post;
use App\Models\Subcategory;
use App\Models\TinhThanh;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function viewHome()
    {
        $ds_post = Post::where('status', Post::HOAT_DONG)
                        ->orderByDESC('id')
                        ->select('id', 'title', 'slug', 'thumbnail', 'price', 'address', 'created_at', 'images')
                        ->take(8)
                        ->get();

        $ds_banner = Banner::orderBy('order')
                        ->select('id', 'image', 'order')
                        ->where('status', 1)
                        ->limit(3)
                        ->get();

        $list_tinh_thanh_options = TinhThanh::orderBy('name')
            ->get()
            ->map(function ($t) {
                return [
                    'id'   => (string) $t->id,
                    'name' => $t->name,
                ];
            })
            ->values()
            ->all();

        return view('Client.Home.index', compact('ds_post', 'ds_banner', 'list_tinh_thanh_options'));
    }

    public function viewPostDetail($slug, $id)
    {
        $post_detail = Post::where('id', $id)
                            ->where('slug', $slug)
                            ->firstOrFail();
        $post_images = json_decode($post_detail->images ?? '[]', true);
        return view('Client.PostDetail.index', compact('post_detail', 'post_images'));
    }

    public function categoryDetail($slug)
    {
        $category   = Subcategory::where('slug', $slug)
                                ->firstOrFail();
        $list_posts = Post::where('id_subcategory', $category->id)
                            ->get();

        return view('Client.CategoryDetail.index', compact('category', 'list_posts'));
    }

    public function viewBlog()
    {
        $ds_blog = Blog::orderByDESC('id')->get();
        $blog_most_viewed = Blog::query()
            ->orderByDesc('views')
            ->orderByDesc('id')
            ->take(5)
            ->get();

        return view('Client.Blog.index', compact('ds_blog', 'blog_most_viewed'));
    }

    public function viewBlogDetail($slug, $id)
    {
        $blog_detail = Blog::where('id', $id)
                            ->where('slug', $slug)
                            ->firstOrFail();

        $blog_detail->views++;
        $blog_detail->save();

        $blog_related = Blog::query()
            ->where('id', '!=', $blog_detail->id)
            ->orderByDesc('id')
            ->take(6)
            ->get();

        return view('Client.BlogDetail.index', compact('blog_detail', 'blog_related'));
    }

    public function viewAllPost(Request $request)
    {
        $query = Post::query()
            ->where('status', Post::HOAT_DONG)
            ->orderByDesc('id');

        if ($request->filled('q')) {
            $term = '%' . addcslashes($request->input('q'), '%_\\') . '%';
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', $term)
                    ->orWhere('address', 'like', $term)
                    ->orWhere('project_name', 'like', $term);
            });
        }

        if ($request->filled('id_tinh_thanh')) {
            $query->where('id_tinh_thanh', (int) $request->input('id_tinh_thanh'));
        }

        if ($request->filled('id_xa_phuong')) {
            $query->where('id_xa_phuong', (int) $request->input('id_xa_phuong'));
        }

        $priceBand = $request->input('price_band');
        if ($priceBand === 'lt1') {
            $query->whereRaw('CAST(price AS UNSIGNED) < ?', [1000000000]);
        } elseif ($priceBand === '1to2') {
            $query->whereRaw('CAST(price AS UNSIGNED) >= ?', [1000000000])
                ->whereRaw('CAST(price AS UNSIGNED) < ?', [2000000000]);
        } elseif ($priceBand === '2to5') {
            $query->whereRaw('CAST(price AS UNSIGNED) >= ?', [2000000000])
                ->whereRaw('CAST(price AS UNSIGNED) <= ?', [5000000000]);
        } elseif ($priceBand === 'gt5') {
            $query->whereRaw('CAST(price AS UNSIGNED) > ?', [5000000000]);
        }

        $areaBand = $request->input('area_band');
        if ($areaBand === 'lt100') {
            $query->where('area', '<', 100);
        } elseif ($areaBand === '100to200') {
            $query->where('area', '>=', 100)->where('area', '<', 200);
        } elseif ($areaBand === '200to500') {
            $query->where('area', '>=', 200)->where('area', '<=', 500);
        } elseif ($areaBand === 'gt500') {
            $query->where('area', '>', 500);
        }

        $ds_post = $query->get();

        $hasFilters = $request->anyFilled([
            'q',
            'id_tinh_thanh',
            'id_xa_phuong',
            'price_band',
            'area_band',
        ]);

        return view('Client.ViewAllPost.index', compact('ds_post', 'hasFilters'));
    }
}
