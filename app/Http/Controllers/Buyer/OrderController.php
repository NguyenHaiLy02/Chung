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
                'trangThaiDonHang' => 'Đang xử lý', // Update according to your business logic
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
        }else {
            $user = Session::get('username'); 
            $diaChiGiaoHang = $request->address; // Địa chỉ giao hàng
            $sdt = $request->phone; // Số điện thoại
            $maSanPham = $request->sanPhamId;
            $soLuong = $request->quantity; // Số lượng sản phẩm
        
            // Tìm thông tin sản phẩm
            $productDetail = TbSanPham::find($maSanPham);
            if (!$productDetail) {
                return back()->with('error', 'Sản phẩm không tồn tại!');
            }
        
            // Lưu đơn hàng (trạng thái đang chờ thanh toán)
            $donHang = TbDonHang::create([
                'taiKhoan' => $user,
                'ngayDatHang' => now(),
                'tongTien' => $productDetail->giaTien * $soLuong,
                'trangThaiDonHang' => 'Đang xử lý',
                'diaChiGiaoHang' => $diaChiGiaoHang,
                'sdt' => $sdt,
                'trangThaiThanhToan' => 'Chưa thanh toán',
            ]);
        
            // Lưu chi tiết đơn hàng
            TbChiTietDonHang::create([
                'maDonHang' => $donHang->id,
                'maSanPham' => $maSanPham,
                'soLuong' => $soLuong,
                'donGia' => $productDetail->giaTien,
            ]);
        
            // Tạo URL thanh toán qua VNPay
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://127.0.0.1:8000/saveOrderOnline";
            $vnp_TmnCode = "B2J4MPE7";
            $vnp_HashSecret = "GJMOFOTJTDUCFICNLVGVBIBLCXLRDDHH";
        
            $vnp_TxnRef = $donHang->id; // Sử dụng ID đơn hàng làm mã giao dịch
            $vnp_OrderInfo = 'Thanh toán hóa đơn #' . $donHang->id;
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $donHang->tongTien * 100; // Tổng tiền (nhân 100 để đổi sang đơn vị VNĐ nhỏ nhất)
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
            $inputData = [
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            ];
        
            if (!empty($vnp_BankCode)) {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
        
            ksort($inputData);
            $query = http_build_query($inputData);
            $hashdata = urldecode($query);
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        
            $vnp_Url .= "?" . $query . '&vnp_SecureHash=' . $vnpSecureHash;
        
            // Chuyển hướng đến VNPay
            return redirect($vnp_Url);
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
