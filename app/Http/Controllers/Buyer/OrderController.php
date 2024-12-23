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
        } else {
                
            $latestOrderId = TbDonHang::max('maDonHang');
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            // thay cổng theo server máy đang chạy http://localhost:8000 
            $vnp_Returnurl = "http://127.0.0.1:8000/vnpay-return?" . http_build_query([
                'tongTien' => $request->totalPrice,
                'diaChiGiaoHang' => $request->address, // Địa chỉ giao hàng
                'sdt' => $request->phone, // Số điện thoại
                'maSanPham' => $request->sanPhamId,
                'soLuong' => $request->quantity,
            ]);

            $vnp_TmnCode = "CGXZLS0Z";
            $vnp_HashSecret = "XNBCJFAKAZQSGTARRLGCHVZWCIOIGSHN";

            $vnp_TxnRef = $latestOrderId+1;
            $vnp_OrderInfo = 'Thanh toan hoa don';
            $vnp_OrderType = 'xtmn';
            $vnp_Amount =  $request->totalPrice*100;
            $vnp_Locale = 'VN';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            $inputData = array(
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
            "vnp_TxnRef" => $vnp_TxnRef
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
            // Chuyển hướng đến VNPay
            return redirect($vnp_Url);
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
        } else  {
            // Chuyển hướng đến VNPay
            $latestOrderId = TbDonHang::max('maDonHang') ?? 0;
            $totalPrice = 0;

            // Tính tổng tiền
            foreach ($request->orderDetails as $orderDetail) {
                $totalPrice += $orderDetail['totalPrice'];
            }

            // Chuẩn bị danh sách sản phẩm
            $orderDetails = array_map(function ($orderDetail) {
                return [
                    'maSanPham' => $orderDetail['sanPhamId'],
                    'soLuong' => $orderDetail['quantity']
                ];
            }, $request->orderDetails);

            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = url('vnpay-returns') . '?' . http_build_query([
                'tongTien' => $totalPrice,
                'diaChiGiaoHang' => $request->address,
                'sdt' => $request->phone,
                'chiTietDonHang' => json_encode($orderDetails)
            ]);

            $vnp_TmnCode = "CGXZLS0Z";
            $vnp_HashSecret = "XNBCJFAKAZQSGTARRLGCHVZWCIOIGSHN";

            $vnp_TxnRef = $latestOrderId+1;
            $vnp_OrderInfo = 'Thanh toan hoa don';
            $vnp_OrderType = 'xtmn';
            $vnp_Amount =  $totalPrice*100;
            $vnp_Locale = 'VN';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            $inputData = array(
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
            "vnp_TxnRef" => $vnp_TxnRef
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
            // Chuyển hướng đến VNPay
            return redirect($vnp_Url);

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

    }

    public function vnpayReturn(Request $request)
    {
        // Lấy các tham số trả về từ VNPAY
        $vnp_ResponseCode = isset($_GET['vnp_ResponseCode']) ? $_GET['vnp_ResponseCode'] : '';

        // Kiểm tra xem thanh toán có bị hủy hay không
        if ($vnp_ResponseCode === '24') {
            // Thực hiện các xử lý khi thanh toán bị hủy
            echo "Thanh toán bị hủy. Xử lý tại đây.";
            return redirect()->route('home');
        } else {
            // Thanh toán thành công, xử lý đơn hàng
            $donHang = TbDonHang::create([
                'taiKhoan' => Session::get('username'), // Giả sử username được lưu trong session
                'ngayDatHang' => now(),
                'tongTien' => $request->input('tongTien'), // Tổng tiền của đơn hàng
                'trangThaiDonHang' => 'Đã duyệt', // Cập nhật theo logic của bạn
                'diaChiGiaoHang' => $request->input('diaChiGiaoHang'), // Địa chỉ giao hàng
                'sdt' => $request->input('sdt'), // Số điện thoại
                'trangThaiThanhToan' => 'Đã thanh toán', // Trạng thái thanh toán
            ]);

            // Lưu chi tiết đơn hàng cho từng sản phẩm trong giỏ hàng
            TbChiTietDonHang::create([
                'maDonHang' => $donHang->maDonHang,
                'maSanPham' => $request->input('maSanPham'),
                'soLuong' => $request->input('soLuong'),
                'donGia' => $request->input('tongTien') /$request->input('soLuong'),
            ]);

            // Giảm số lượng tồn kho của sản phẩm
            $sanPham = TbSanPham::find($request->input('maSanPham'));
            if ($sanPham) {
                $sanPham->soLuongTonKho -= $request->input('soLuong'); // Giảm số lượng tồn kho
                $sanPham->save(); // Lưu thay đổi vào cơ sở dữ liệu
            }

            return view('buyer.order.orderSuccess', [
                'order' => $donHang,
                'orderDetails' => TbChiTietDonHang::where('maDonHang', $donHang->maDonHang)->get()
            ]);
        }
        
    }    
    public function vnpayReturns(Request $request)
    {
        // Lấy các tham số trả về từ VNPAY
        $vnp_ResponseCode = $request->input('vnp_ResponseCode', '');

        // Kiểm tra xem thanh toán có bị hủy hay không
        if ($vnp_ResponseCode === '24') {
            // Thực hiện các xử lý khi thanh toán bị hủy
            echo "Thanh toán bị hủy. Xử lý tại đây.";
            return redirect()->route('home');
        }

        // Thanh toán thành công, xử lý đơn hàng
        $donHang = TbDonHang::create([
            'taiKhoan' => Session::get('username'), // Giả sử username được lưu trong session
            'ngayDatHang' => now(),
            'tongTien' => $request->input('tongTien'), // Tổng tiền của đơn hàng
            'trangThaiDonHang' => 'Đã duyệt', // Cập nhật theo logic của bạn
            'diaChiGiaoHang' => $request->input('diaChiGiaoHang'), // Địa chỉ giao hàng
            'sdt' => $request->input('sdt'), // Số điện thoại
            'trangThaiThanhToan' => 'Đã thanh toán', // Trạng thái thanh toán
        ]);

        // Lưu chi tiết đơn hàng cho từng sản phẩm
        $orderDetails = json_decode($request->input('chiTietDonHang'), true);
        foreach ($orderDetails as $detail) {

        $maSP = TbSanPham::find($detail['maSanPham']);
            TbChiTietDonHang::create([
                'maDonHang' => $donHang->maDonHang,
                'maSanPham' => $detail['maSanPham'],
                'soLuong' => $detail['soLuong'],
                'donGia' => $maSP->giaTien,
            ]);

            // Giảm số lượng tồn kho của sản phẩm
            $sanPham = TbSanPham::find($detail['maSanPham']);
            if ($sanPham) {
                $sanPham->soLuongTonKho -= $detail['soLuong']; // Giảm số lượng tồn kho
                $sanPham->save(); // Lưu thay đổi vào cơ sở dữ liệu
            }
        }
        // Xóa các sản phẩm đã được đặt trong giỏ hàng
        foreach ($orderDetails as $detailDelete) {
            TbGioHang::where('taiKhoan', Session::get('username'))
                ->where('maSanPham', $detailDelete['maSanPham'])
                ->delete(); // Xóa sản phẩm khỏi giỏ hàng của người dùng
        }
        // Trả về view thông báo thành công
        return view('buyer.order.orderSuccess', [
            'order' => $donHang,
            'orderDetails' => TbChiTietDonHang::where('maDonHang', $donHang->maDonHang)->get()
        ]);
    }

}
