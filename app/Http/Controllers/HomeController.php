<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function viewHome()
    {
        $ds_post = Post::orderByDESC('id')
                        ->select('id', 'title', 'slug', 'thumbnail', 'price', 'address', 'created_at', 'images')
                        ->take(8)
                        ->get();

        $ds_banner = Banner::orderBy('order')
                        ->select('id', 'image', 'order')
                        ->where('status', 1)
                        ->limit(3)
                        ->get();

        return view('Client.Home.index', compact('ds_post', 'ds_banner'));
    }

    public function viewPostDetail($slug, $id)
    {
        $post_detail = Post::where('id', $id)->first();
        $post_images = json_decode($post_detail->images ?? '[]', true);
        return view('Client.PostDetail.index', compact('post_detail', 'post_images'));
    }

    public function categoryDetail($slug)
    {
        $category = Subcategory::where('slug', $slug)->first();

        $list_posts = Post::where('id_subcategory', $category->id)->get();

        return view('Client.CategoryDetail.index', compact('category', 'list_posts'));
    }

    public function viewAllPost()
    {
        $ds_post = Post::orderByDESC('id')->get();
        return view('Client.ViewAllPost.index', compact('ds_post'));
    }
}
