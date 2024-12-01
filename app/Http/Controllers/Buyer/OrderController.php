<?php

namespace App\Http\Controllers\Buyer;
use App\Models\TbDonHang;
use App\Models\TbChiTietDonHang;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\TbTaiKhoan; 
use App\Models\TbSanPham; // Thêm dòng này
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Phương thức tạo đơn hàng
    public function create(Request $request, $sanPhamId)
    {
        $username = session('username'); // Lấy username từ session
        if ($username) {
            $quyen = TbTaiKhoan::where('taiKhoan', $username)->value('quyen'); // Lấy quyền duy nhất
            if ($quyen === 'khachhang') {
                // Lấy số lượng từ request, mặc định là 1 nếu không có
                $quantity = $request->input('quantity', 1); 
                // Lấy sản phẩm từ ID
                $sanPham = TbSanPham::findOrFail($sanPhamId); 

                // Trả về view đặt hàng với sản phẩm và số lượng
                return view('buyer.order.orderProduct', compact('sanPham', 'quantity'));
            }
        }
        return redirect()->route('login');
         
    }

    // Phương thức lưu đơn hàng
    public function store(Request $request)
    {
        // Check if the payment method is "cod"
        if ($request->paymentMethod == 'cod') {
            // Save the order in TbDonHang table
            $donHang = TbDonHang::create([
                'taiKhoan' => Session::get('username'), // Assuming the username is stored in session
                'ngayDatHang' => now(),
                'tongTien' => $request->totalPrice,
                'trangThaiDonHang' => 'Chưa giao', // Update according to your business logic
                'diaChiGiaoHang' => $request->address, // Assuming the user inputs their delivery address
                'sdt' => $request->phone, // Assuming the user provides phone number
                'trangThaiThanhToan' => 'Chưa thanh toán', // Payment status
            ]);

            // Create order details for each product in the cart
            TbChiTietDonHang::create([
                'maDonHang' => $donHang->id,
                'maSanPham' => $request->sanPhamId,
                'soLuong' => $request->quantity,
                'donGia' => $request->totalPrice / $request->quantity,
            ]);

            // Redirect to a confirmation page or another action
            return view('buyer.order.orderSuccess', [
                'order' => $donHang,
                'orderDetails' => TbChiTietDonHang::where('maDonHang', $donHang->id)->get()
            ]);
        }

        // Add logic for other payment methods (e.g., NVPay) here

        return back()->with('error', 'Lỗi khi đặt hàng!');
    }

    public function confirm(Request $request)
    {
        // Xử lý logic xác nhận đơn hàng tại đây
        return redirect()->route('order.store');  // Hoặc xử lý theo yêu cầu của bạn
    }
}
