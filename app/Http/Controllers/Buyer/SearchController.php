<?php
namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\TbSanPham;
use App\Models\TbDanhMuc;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Lấy từ khóa tìm kiếm
        $searchTerm = $request->input('search');
        
        // Tìm sản phẩm theo tên
        $allSanPhams = TbSanPham::where('tenSanPham', 'like', '%' . $searchTerm . '%')->get();
        
        // Lấy các danh mục
        $danhMucs = TbDanhMuc::all();
        
        // Trả về kết quả tìm kiếm tới view index
        return view('buyer.home.index', compact('allSanPhams', 'danhMucs', 'searchTerm'));
    }
}
