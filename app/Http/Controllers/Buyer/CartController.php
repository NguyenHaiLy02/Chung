<?php

namespace App\Http\Controllers\Buyer;

use App\Models\TbGioHang;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        // Lấy tất cả sản phẩm trong giỏ hàng của người dùng
        $cartItems = TbGioHang::where('taiKhoan', auth()->id())->get();

        return view('buyer.cart.index', compact('cartItems'));
    }
}