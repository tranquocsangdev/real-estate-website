<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function getDataCategory()
    {
        $data = Category::select('id', 'name', 'icon', 'status')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return response()->json([
            'data'   => $data,
        ]);
    }

    public function getDataCategoryOpen()
    {
        $data = Category::select('id', 'name', 'status')
                        ->where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return response()->json([
            'data'   => $data,
        ]);
    }

    public function createCategory(CreateRequest $request)
    {
        DB::transaction(function () use ($request) {
            Category::create([
                'name'  => $request->name,
                'slug'  => Str::slug($request->name),
                'icon'  => $request->icon,
            ]);
        });

        return response()->json([
            'status'    => true,
            'message' => 'Đã tạo danh mục thành công',
        ]);
    }

    public function updateCategory(UpdateRequest $request)
    {
        $category = Category::find($request->id);

        DB::transaction(function () use ($request, $category) {
            $category->update([
                'name'  => $request->name,
                'slug'  => Str::slug($request->name),
                'icon'  => $request->icon,
            ]);
        });

        return response()->json([
            'status'    => true,
            'message' => 'Đã cập nhật danh mục thành công',
        ]);
    }

    public function deleteCategory(Request $request)
    {
        $category = Category::find($request->id);

        if ($category) {
            Subcategory::where('id_category', $category->id)->delete();
            $category->delete();

            return response()->json([
                'status'  => true,
                'message' => 'Đã xóa danh mục và các danh mục con thành công',
            ]);
        }


        return response()->json([
            'status'    => false,
            'message' => 'Danh mục không tồn tại',
        ]);
    }

    public function changeStatusCategory(Request $request)
    {
        $category = Category::find($request->id);
        $category->status = !$category->status;
        $category->save();

        $message = $category->status
            ? 'Tình trạng đã đổi thành: <b>Đang Mở</b>'
            : 'Tình trạng đã đổi thành: <b>Đã Tắt</b>';

        return response()->json([
            'status'         => true,
            'message'        => $message,
        ]);
    }
}
