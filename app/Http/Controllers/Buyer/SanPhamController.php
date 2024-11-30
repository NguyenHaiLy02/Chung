<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\TbSanPham;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    public function show($id)
    {
        // Tìm sản phẩm theo ID và eager load hình ảnh và nhà cung cấp liên quan
        $sanPham = TbSanPham::with(['hinhAnhSps', 'nhaCungCap'])->findOrFail($id);
        
        // Trả về view với thông tin sản phẩm và nhà cung cấp
        return view('buyer.product.index', compact('sanPham'));
    }
}
