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
        return view('Client.Home.index');
    }

    public function getDataPost()
    {
        $data = Post::get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function getDataCategory()
    {
        $data = Category::join('subcategories', 'categories.id', 'subcategories.id_category')
                        ->select(
                            'categories.id',
                            'categories.name',
                            'subcategories.id as sub_id',
                            'subcategories.name as sub_name',
                            'subcategories.slug as sub_slug',
                            'subcategories.id_category'
                        )
                        ->where('categories.status', 1)
                        ->where('subcategories.status', 1)
                        ->get();

        $groupedData = $data->groupBy('id');

        $result = [];
        foreach ($groupedData as $value => $key) {
            $parent = [
                'id'            => $key[0]['id'],
                'name'          => $key[0]['name'],
            ];

            foreach ($key as $sub) {
                $parent['subcategories'][] = [
                    'sub_id' => $sub['sub_id'],
                    'sub_name' => $sub['sub_name'],
                    'sub_slug' => $sub['sub_slug'],
                ];
            }

            $result[] = $parent;
        }

        // Nếu bạn muốn Category không có Subcategory cũng được hiển thị, bạn cần query Category riêng và merge lại.
        // Với yêu cầu hiện tại (dữ liệu join), cách trên là đủ.

        return response()->json([
            'data' => $result,
        ]);
    }

    public function categoryDetail($slug)
    {
        $category = Subcategory::where('slug', $slug)->first();

        $list_posts = Post::where('id_category', $category->id)->get();

        return view('Client.CategoryDetail.index', compact('category', 'list_posts'));
    }
}
