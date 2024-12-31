<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\TbYeuCauNhapHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductImportRequestController extends Controller
{
    public function index()
    {
        // Lấy thông tin yêu cầu nhập hàng liên quan đến nhà cung cấp hiện tại
        $requests = TbYeuCauNhapHang::with(['chiTietYeuCau.tinDangSanPham'])
            ->whereHas('chiTietYeuCau.tinDangSanPham.nhaCungCap')->get();
    
        // Trả về view với danh sách yêu cầu nhập hàng
        return view('owner.product_import_request.index', compact('requests'));
    }
    public function show($id)
    {
        // Lấy yêu cầu nhập hàng cùng các chi tiết liên quan
        $orderRequest = TbYeuCauNhapHang::with(['chiTietYeuCau.tinDangSanPham.hinhanhtindang'])
            ->findOrFail($id);

        // Trả về view chi tiết yêu cầu nhập hàng
        return view('owner.product_import_request.show', compact('orderRequest'));
    }
}
