<?php

namespace App\Http\Controllers\Buyer;
use App\Models\TbDonHang;
use App\Models\TbChiTietDonHang;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\TbTaiKhoan; 
use App\Models\TbGioHang;
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
        // Kiểm tra phương thức thanh toán là "cod"
        if ($request->paymentMethod == 'cod') {
            // Lưu đơn hàng vào bảng TbDonHang
            $donHang = TbDonHang::create([
                'taiKhoan' => Session::get('username'), // Giả sử username được lưu trong session
                'ngayDatHang' => now(),
                'tongTien' => $request->totalPrice, // Tổng tiền của đơn hàng
                'trangThaiDonHang' => 'Đang xử lý', // Cập nhật theo logic của bạn
                'diaChiGiaoHang' => $request->address, // Địa chỉ giao hàng
                'sdt' => $request->phone, // Số điện thoại
                'trangThaiThanhToan' => 'Chưa thanh toán', // Trạng thái thanh toán
            ]);

            // Lưu chi tiết đơn hàng cho từng sản phẩm trong giỏ hàng
            TbChiTietDonHang::create([
                'maDonHang' => $donHang->maDonHang,
                'maSanPham' => $request->sanPhamId,
                'soLuong' => $request->quantity,
                'donGia' => $request->totalPrice / $request->quantity,
            ]);

            // Giảm số lượng tồn kho của sản phẩm
            $sanPham = TbSanPham::find($request->sanPhamId);
            if ($sanPham) {
                $sanPham->soLuongTonKho -= $request->quantity; // Giảm số lượng tồn kho
                $sanPham->save(); // Lưu thay đổi vào cơ sở dữ liệu
            }

            // Chuyển hướng đến trang xác nhận đơn hàng hoặc hành động khác
            return view('buyer.order.orderSuccess', [
                'order' => $donHang,
                'orderDetails' => TbChiTietDonHang::where('maDonHang', $donHang->maDonHang)->get()
            ]);
        } else {
            // Logic cho các phương thức thanh toán khác (ví dụ: NVPay) có thể ở đây
        }

        // Trả về nếu có lỗi khi đặt hàng
        return back()->with('error', 'Lỗi khi đặt hàng!');
    }


    public function fromCart(Request $request)
    {
        // Kiểm tra phương thức thanh toán
        if ($request->paymentMethod == 'cod') {
            // Tính tổng tiền từ các chi tiết đơn hàng
            $totalPrice = 0;
            foreach ($request->orderDetails as $orderDetail) {
                $totalPrice += $orderDetail['totalPrice']; // Tổng tiền của các sản phẩm
            }
    
            // Lưu đơn hàng vào bảng TbDonHang
            $donHang = TbDonHang::create([
                'taiKhoan' => Session::get('username'), // Giả sử username được lưu trong session
                'ngayDatHang' => now(),
                'tongTien' => $totalPrice, // Tổng tiền của đơn hàng
                'trangThaiDonHang' => 'Đang xử lý', // Cập nhật theo logic của bạn
                'diaChiGiaoHang' => $request->address, // Địa chỉ giao hàng
                'sdt' => $request->phone, // Số điện thoại
                'trangThaiThanhToan' => 'Chưa thanh toán', // Trạng thái thanh toán
            ]);
    
            // Lưu chi tiết đơn hàng cho từng sản phẩm trong giỏ hàng
            foreach ($request->orderDetails as $orderDetail) {
                TbChiTietDonHang::create([
                    'maDonHang' => $donHang->maDonHang,
                    'maSanPham' => $orderDetail['sanPhamId'],
                    'soLuong' => $orderDetail['quantity'],
                    'donGia' => $orderDetail['totalPrice'] / $orderDetail['quantity'],
                ]);
    
                // Giảm số lượng tồn kho của sản phẩm
                $sanPham = TbSanPham::find($orderDetail['sanPhamId']);
                if ($sanPham) {
                    $sanPham->soLuongTonKho -= $orderDetail['quantity']; // Giảm số lượng tồn kho
                    $sanPham->save(); // Lưu thay đổi
                }
            }
    
            // Xóa các sản phẩm đã được đặt trong giỏ hàng
            foreach ($request->orderDetails as $orderDetail) {
                TbGioHang::where('taiKhoan', Session::get('username'))
                    ->where('maSanPham', $orderDetail['sanPhamId'])
                    ->delete(); // Xóa sản phẩm khỏi giỏ hàng của người dùng
            }
    
            // Chuyển hướng đến trang xác nhận đơn hàng hoặc hành động khác
            return view('buyer.order.orderSuccess', [
                'order' => $donHang,
                'orderDetails' => TbChiTietDonHang::where('maDonHang', $donHang->maDonHang)->get()
            ]);
        } else {
            // Logic cho các phương thức thanh toán khác (ví dụ: NVPay) có thể ở đây
        }
    
        // Trả về nếu có lỗi khi đặt hàng
        return back()->with('error', 'Lỗi khi đặt hàng!');
    }
    
    public function confirmAll($orderId)
    {
        // Tìm đơn hàng theo 'maDonHang'
        $order = TbDonHang::where('maDonHang', $orderId)->first();
    
        // Kiểm tra nếu đơn hàng tồn tại
        if ($order) {
            $order->trangThaiDonHang = 'Đã nhận'; // Cập nhật trạng thái đơn hàng
            $order->save(); // Lưu thay đổi
        }
    
        // Quay lại trang đơn hàng
        return redirect()->route('orders');
    }
    

}
