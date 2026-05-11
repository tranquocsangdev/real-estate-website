<?php

namespace App\Http\Controllers;

use App\Models\TinhThanh;
use App\Models\XaPhuong;
use Illuminate\Http\Request;

class DiaPhanController extends Controller
{
    public function listTinhThanh()
    {
        $data = TinhThanh::get();

        return response()->json([
            'status' => true,
            'data'   => $data,
        ]);
    }

    public function listXaPhuong(Request $request)
    {
        $tinhThanh = TinhThanh::where('id', $request->id_tinh_thanh)->first();

        $data = XaPhuong::where('id_code_tinh_thanh', $tinhThanh->code)->get();

        return response()->json([
            'status' => true,
            'data'   => $data,
        ]);
    }
}
