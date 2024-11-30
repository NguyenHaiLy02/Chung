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
        // Lấy danh mục cùng sản phẩm và hình ảnh liên kết
        $danhMucs = TbDanhMuc::with(['sanPhams.hinhAnhSps'])->get();

        // Lấy tất cả sản phẩm kèm hình ảnh
        $allSanPhams = TbSanPham::with('hinhAnhSps')->get();

        return view('buyer.home.index', compact('danhMucs', 'allSanPhams'));
    }
}
