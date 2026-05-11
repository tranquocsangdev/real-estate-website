<?php

namespace App\Http\Controllers;

use App\Models\TinhThanh;
use App\Models\XaPhuong;
use Illuminate\Http\Request;

class DiaPhanController extends Controller
{
    public function listTinhThanh()
    {
        $data = TinhThanh::query()
            ->orderBy('name')
            ->get(['id', 'code', 'name', 'administrative_level']);

        return response()->json([
            'status' => true,
            'data'   => $data,
        ]);
    }

    public function listXaPhuong(Request $request)
    {
        $request->validate([
            'id_tinh_thanh' => ['required', 'integer', 'exists:tinh_thanhs,id'],
        ]);

        $tinh = TinhThanh::query()->findOrFail($request->id_tinh_thanh);

        $data = XaPhuong::query()
            ->where('id_thuoc_tinh_thanh', $tinh->code)
            ->orderBy('name')
            ->get(['id', 'code', 'name', 'administrative_level', 'id_thuoc_tinh_thanh']);

        return response()->json([
            'status' => true,
            'data'   => $data,
        ]);
    }
}
