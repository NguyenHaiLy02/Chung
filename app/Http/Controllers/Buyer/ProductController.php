<?php
namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\TbSanPham;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        // Tìm sản phẩm theo ID và eager load các quan hệ hình ảnh, nhà cung cấp và đánh giá sản phẩm
        $sanPham = TbSanPham::with(['hinhAnhSps', 'nhaCungCap', 'chiTietDonHangs.danhGiaSanPhams'])->findOrFail($id);
        
        // Trả về view với thông tin sản phẩm và đánh giá
        return view('buyer.product.index', compact('sanPham'));
    }
   
}
