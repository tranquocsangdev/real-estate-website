<?php

namespace App\Http\Controllers;

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
                        ->get();

        return view('Client.Home.index', compact('ds_post'));
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
}
