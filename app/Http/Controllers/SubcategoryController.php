<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subcategory\CreateRequest;
use App\Http\Requests\Subcategory\UpdateRequest;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function getDataSubCategory(Request $request)
    {
        $data = Subcategory::join('categories', 'subcategories.id_category', 'categories.id')
                            ->select('subcategories.*', 'categories.name as category_name')
                            ->orderBy('subcategories.id', 'desc')
                            ->get();

        return response()->json([
            'data'  => $data,
        ]);
    }

    public function getDataSubCategoryPost(Request $request)
    {
        $data = Subcategory::where('id_category', $request->id_category)
                            ->where('status', 1)
                            ->get();

        return response()->json([
            'data'  => $data
        ]);
    }

    public function createSubCategory(CreateRequest $request)
    {
        DB::transaction(function () use ($request) {
            Subcategory::create([
                'name'          => $request->name,
                'slug'          => Str::slug($request->name),
                'icon'          => $request->icon,
                'id_category'   => $request->id_category,
            ]);
        });

        return response()->json([
            'status'    => true,
            'message' => 'Đã tạo danh mục thành công',
        ]);
    }

    public function updateSubCategory(UpdateRequest $request)
    {
        $sub_category = Subcategory::find($request->id);

        DB::transaction(function () use ($request, $sub_category) {
            $sub_category->update([
                'name'          => $request->name,
                'slug'          => Str::slug($request->name),
                'icon'          => $request->icon,
                'id_category'   => $request->id_category,
            ]);
        });

        return response()->json([
            'status'    => true,
            'message' => 'Đã cập nhật danh mục thành công',
        ]);
    }

    public function deleteSubCategory(Request $request)
    {
        $sub_category = Subcategory::find($request->id);

        if ($sub_category) {
            $sub_category->delete();
            return response()->json([
                'status'    => true,
                'message' => 'Đã xóa danh mục thành công',
            ]);
        }

        return response()->json([
            'status'    => false,
            'message' => 'Danh mục không tồn tại',
        ]);
    }

    public function changeStatusSubCategory(Request $request)
    {
        $sub_category = Subcategory::find($request->id);
        $sub_category->status = !$sub_category->status;
        $sub_category->save();

        $message = $sub_category->status
            ? 'Tình trạng đã đổi thành: <b>Đang Mở</b>'
            : 'Tình trạng đã đổi thành: <b>Đã Tắt</b>';

        return response()->json([
            'status'         => true,
            'message'        => $message,
        ]);
    }
}
