<?php

namespace App\Http\Controllers\Buyer;

use App\Models\TbGioHang;
use App\Models\TbSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cartItems = TbGioHang::where('taiKhoan', auth()->id())->get();
        return view('buyer.cart.index', compact('cartItems'));
    }

    // Cập nhật giỏ hàng
    public function update(Request $request)
{
    foreach ($request->quantity as $itemId => $quantity) {
        $cartItem = TbGioHang::where('id', $itemId)
            ->where('taiKhoan', auth()->id())
            ->first();

        if ($cartItem && $quantity > 0) {
            $cartItem->soLuong = $quantity;
            $cartItem->save();
        } elseif ($cartItem && $quantity == 0) {
            $cartItem->delete();
        }
    }

    return redirect()->route('cart.index')->with('success', 'Cập nhật giỏ hàng thành công!');
    }


    // Xóa sản phẩm khỏi giỏ hàng
    // public function remove($id)
    // {
    //     $cartItem = TbGioHang::where('id', $id)
    //         ->where('taiKhoan', auth()->id())
    //         ->first();

    //     if ($cartItem) {
    //         $cartItem->delete();
    //         return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    //     }

    //     return redirect()->route('cart.index')->with('error', 'Không tìm thấy sản phẩm trong giỏ hàng.');
    // }
}
