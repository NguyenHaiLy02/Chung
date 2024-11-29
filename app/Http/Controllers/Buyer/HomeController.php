<?php

namespace App\Http\Controllers\Buyer;

use App\Models\TbDanhMuc;
use App\Models\TbSanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $danhMucs = TbDanhMuc::with('sanPhams')->get(); // Lấy tất cả danh mục cùng sản phẩm
        $allSanPhams = TbSanPham::all(); // Lấy tất cả sản phẩm

        return view('buyer.home.index', compact('danhMucs', 'allSanPhams'));
    }

}
