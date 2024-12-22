<?php

namespace App\Http\Controllers\Buyer;
use App\Models\TbDonHang;
use App\Models\TbChiTietDonHang;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\TbTaiKhoan; 
use App\Models\TbGioHang;
use App\Models\TbSanPham;
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

    //  
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
        } else if ($request->paymentMethod == 'vnpay') {
            return $this->vnpayPayment($request); // Chuyển hướng đến VNPay
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
        } else if ($request->paymentMethod == 'vnpay') {
            return $this->vnpayPayment($request); // Chuyển hướng đến VNPay
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
    
    public function confirmOrder(Request $request, $maDonHang)
    {
        $order = TbDonHang::where('maDonHang', $maDonHang)->first();
    
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Đơn hàng không tồn tại'], 404);
        }
    
        $order->trangThaiDonHang = $request->status;
        $order->save();
    
        return response()->json(['success' => true, 'message' => 'Trạng thái đã được cập nhật']);
    }
    public function vnpayPayment(Request $request)
    {
        $vnp_TmnCode = env('VNPAY_TMN_CODE'); // Mã website lấy từ .env
        $vnp_HashSecret = env('VNPAY_HASH_SECRET'); // Chuỗi bí mật lấy từ .env
        $vnp_Url = env('VNPAY_URL');
        $vnp_Returnurl = env('VNPAY_RETURN_URL'); // URL sau khi thanh toán xong

        // Thông tin đơn hàng
        $vnp_TxnRef = uniqid(); // Mã giao dịch duy nhất (có thể là số thứ tự đơn hàng)
        $vnp_OrderInfo = 'Thanh toán đơn hàng'; // Mô tả đơn hàng
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->totalPrice * 100; // VNPay yêu cầu đơn vị là VNĐ * 100 (VND)
        $vnp_Locale = 'vn'; // Đặt ngôn ngữ là tiếng Việt
        $vnp_BankCode = $request->bankCode; // Mã ngân hàng, có thể để trống
        $vnp_IpAddr = $request->ip(); // Địa chỉ IP của người dùng

        $inputData = [
            'vnp_Version' => '2.1.0',
            'vnp_TmnCode' => $vnp_TmnCode,
            'vnp_Amount' => $vnp_Amount,
            'vnp_Command' => 'pay',
            'vnp_CreateDate' => now()->format('YmdHis'),
            'vnp_CurrCode' => 'VND',
            'vnp_IpAddr' => $vnp_IpAddr,
            'vnp_Locale' => $vnp_Locale,
            'vnp_OrderInfo' => $vnp_OrderInfo,
            'vnp_OrderType' => $vnp_OrderType,
            'vnp_ReturnUrl' => $vnp_Returnurl,
            'vnp_TxnRef' => $vnp_TxnRef,
        ];

        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        // Tạo URL thanh toán VNPay
        ksort($inputData);  // Sắp xếp mảng theo key
        $query = http_build_query($inputData);  // Tạo query string
        $hashData = urldecode($query);  // Đảm bảo không có ký tự đặc biệt
        $vnp_Url .= '?' . $query;  // Tạo đường dẫn URL

        // Tạo chữ ký bảo mật
        if (!empty($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
            $vnp_Url .= '&vnp_SecureHash=' . $vnpSecureHash;  // Thêm chữ ký vào URL
        }

        // Chuyển hướng đến VNPay
        return redirect($vnp_Url);
    }


    public function vnpayReturn(Request $request)
    {
        $inputData = $request->all();
        $vnp_HashSecret = env('VNPAY_HASH_SECRET'); // Lấy chuỗi bí mật từ .env

        // Kiểm tra tính hợp lệ của chữ ký
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash'], $inputData['vnp_SecureHashType']);

        ksort($inputData);
        $hashData = urldecode(http_build_query($inputData));
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash === $vnp_SecureHash) {
            // Kiểm tra mã giao dịch trả về
            if ($inputData['vnp_ResponseCode'] == '00') {
                // Thanh toán thành công, xử lý đơn hàng
                $donHang = TbDonHang::create([
                    'taiKhoan' => Session::get('username'),
                    'ngayDatHang' => now(),
                    'tongTien' => $inputData['vnp_Amount'] / 100,
                    'trangThaiDonHang' => 'Đang xử lý',
                    'trangThaiThanhToan' => 'Đã thanh toán',
                    'maGiaoDich' => $inputData['vnp_TransactionNo'],
                ]);

                return view('buyer.order.orderSuccess', ['order' => $donHang]);
            } else {
                return redirect()->route('home')->with('error', 'Thanh toán không thành công!');
            }
        } else {
            return redirect()->route('home')->with('error', 'Chữ ký không hợp lệ!');
        }
    }    
}
