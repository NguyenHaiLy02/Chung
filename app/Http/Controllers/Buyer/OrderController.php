<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\TbSanPham; // Thêm dòng này
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Phương thức tạo đơn hàng
    public function create(Request $request, $sanPhamId)
    {
        // Lấy số lượng từ request, mặc định là 1 nếu không có
        $quantity = $request->input('quantity', 1); 
        // Lấy sản phẩm từ ID
        $sanPham = TbSanPham::findOrFail($sanPhamId); 

        // Trả về view đặt hàng với sản phẩm và số lượng
        return view('buyer.order.orderProduct', compact('sanPham', 'quantity')); 
    }

    // Phương thức lưu đơn hàng
    public function store(Request $request)
    {
        // Xử lý logic lưu đơn hàng
        $validated = $request->validate([
            'sanPhamId' => 'required|exists:tbsanpham,maSanPham',
            'quantity' => 'required|integer|min:1',
            'customerName' => 'required|string|max:255',
            'customerPhone' => 'required|string|max:15',
            'customerAddress' => 'required|string|max:255',
        ]);

        // Thực hiện các logic lưu đơn hàng tại đây
    }
}
