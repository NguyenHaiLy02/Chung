<?php

namespace App\Http\Controllers\Buyer;

use App\Models\TbGioHang;
use Illuminate\Http\Request;
use App\Models\TbSanPham;
use App\Models\TbHinhAnhSp;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request)
    {
        $taiKhoan = auth()->user()->taiKhoan;
        $maSanPham = $request->maSanPham;
        $soLuong = $request->input('quantity', 1);

        // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng
        $gioHang = TbGioHang::where('taiKhoan', $taiKhoan)
                            ->where('maSanPham', $maSanPham)
                            ->first();

        if ($gioHang) {
            // Nếu đã có, tăng số lượng
            $gioHang->soLuong += $soLuong;
            $gioHang->save();
        } else {
            // Nếu chưa có, tạo mới
            TbGioHang::create([
                'taiKhoan' => $taiKhoan,
                'maSanPham' => $maSanPham,
                'soLuong' => $soLuong,
            ]);
        }

        return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công!');
    }

    // Hiển thị giỏ hàng
    public function index()
    {
        $cartItems = TbGioHang::where('taiKhoan', auth()->id())->get();

        // Retrieve additional product details for each item
        foreach ($cartItems as $item) {
            $item->sanPham = $item->sanPham; // Eager load the related product
            $item->totalPrice = $item->sanPham->giaTien * $item->soLuong; // Calculate total price for each item
        }

        return view('buyer.cart.index', compact('cartItems'));
    }

    public function removeItem($id)
    {
        try {
            // Lấy item trong giỏ hàng dựa vào id
            $cartItem = TbGioHang::findOrFail($id);
    
            // Kiểm tra xem item có thuộc về người dùng hiện tại không
            if ($cartItem->taiKhoan !== auth()->user()->taiKhoan) {
                return response()->json(['success' => false, 'message' => 'Bạn không có quyền xóa sản phẩm này.'], 403);
            }
    
            // Xóa sản phẩm khỏi giỏ hàng
            $cartItem->delete();
    
            // Trả về kết quả thành công dưới dạng JSON
            return response()->json(['success' => true, 'message' => 'Xóa sản phẩm thành công.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra khi xóa sản phẩm.'], 500);
        }
    }
    
    public function showCart()
    {
        $cartItems = TbGioHang::with('sanPham.hinhAnhSps')
            ->where('taiKhoan', auth()->user()->taiKhoan)
            ->get()
            ->map(function ($item) {
                $item->totalPrice = $item->sanPham->giaTien * $item->soLuong; // Tính tổng tiền mỗi sản phẩm
                return $item;
            });
    
        return view('buyer.cart.index', compact('cartItems'));
    }
    
    public function calculateTotal(Request $request)
    {
        $selectedItems = $request->input('selectedItems', []);
        $items = TbGioHang::whereIn('id', $selectedItems)
            ->where('taiKhoan', auth()->user()->taiKhoan)
            ->get();
    
        $totalPrice = 0;
        foreach ($items as $item) {
            $totalPrice += $item->sanPham->giaTien * $item->soLuong; // Tính tổng tiền
        }
    
        return redirect()->back()->with('total', $totalPrice);
    }

    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'soLuong' => 'required|integer|min:1',
        ]);
    
        try {
            $cartItem = TbGioHang::findOrFail($id);
    
            // Kiểm tra quyền sở hữu
            if ($cartItem->taiKhoan !== auth()->user()->taiKhoan) {
                return response()->json(['message' => 'Bạn không có quyền chỉnh sửa sản phẩm này.'], 403);
            }
    
            // Cập nhật số lượng
            $cartItem->soLuong = $request->input('soLuong');
            $cartItem->save();
    
            // Tính lại tổng tiền của sản phẩm
            $totalPrice = $cartItem->sanPham->giaTien * $cartItem->soLuong;
    
            return response()->json([
                'message' => 'Cập nhật số lượng thành công.',
                'totalPrice' => number_format($totalPrice, 0, ',', '.') . ' VNĐ',
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Có lỗi xảy ra.'], 500);
        }
    }

    public function placeOrder(Request $request)
    {
        // Lấy các sản phẩm đã chọn từ giỏ hàng
        $selectedItems = $request->input('selectedItems'); // Các sản phẩm đã chọn
        $quantities = $request->input('soLuong'); // Số lượng của từng sản phẩm

        // Kiểm tra nếu không có sản phẩm nào được chọn
        if (empty($selectedItems)) {
            return redirect()->back()->with('error', 'Vui lòng chọn sản phẩm để đặt hàng.');
        }

        // Lấy thông tin các sản phẩm đã chọn từ giỏ hàng
        $cartItems = TbGioHang::whereIn('id', $selectedItems)->get();

        // Mảng lưu thông tin đơn hàng
        $orderDetails = [];
        foreach ($cartItems as $item) {
            // Lấy sản phẩm từ giỏ hàng
            $sanPham = TbSanPham::findOrFail($item->sanPham->maSanPham);
            
            // Lấy giỏ hàng của người dùng cho sản phẩm này
            $giohang = TbGioHang::where('taiKhoan', auth()->user()->taiKhoan)
                                ->where('maSanPham', $item->sanPham->maSanPham)
                                ->firstOrFail();  // Dùng firstOrFail để chắc chắn có giỏ hàng cho sản phẩm này
            
            $hinhanh = TbHinhAnhSp::where('maSanPham',$sanPham->maSanPham)->firstOrFail();;
            // Lấy số lượng từ input
            $quantity = $giohang->soLuong; // Nếu không có số lượng, mặc định là 1
        
            // Tính tổng giá của sản phẩm
            $totalPrice = $sanPham->giaTien * $quantity;
        
            // Lưu thông tin đơn hàng
            $orderDetails[] = [
                'sanPhamId' => $sanPham->maSanPham,
                'hinhanh'=> $hinhanh->hinhAnh,
                'tenSanPham'=> $sanPham->tenSanPham,
                'quantity' => $quantity,
                'totalPrice' => $totalPrice,
            ];
        }
        

        // Truyền dữ liệu sang view orderProduct.blade.php
        return view('buyer.cart.orderProduct', compact('orderDetails'));
    }

}
