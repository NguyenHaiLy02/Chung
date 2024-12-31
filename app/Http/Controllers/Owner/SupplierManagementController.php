<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\TbNhaCungCap;
use App\Models\TbYeuCauNhapHang;
use App\Models\TbChiTietYeuCauNhapHang;
use App\Models\TbTinDangSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SupplierManagementController extends Controller
{
    // public function index()
    // {
    //     // Lấy dữ liệu từ bảng tbNhaCungCap, tbTaiKhoan, tbChungNhan
    //     $suppliers = TbNhaCungCap::with(['taiKhoan', 'danhMuc', 'sanPhams', 'chungNhans'])->get();

    //     // Truyền dữ liệu sang view
    //     return view('owner.supplier_management.index', compact('suppliers'));
    // }
    public function index(Request $request)
    {
        
        // Lấy giá trị lọc từ request
        $filter = $request->get('filter', 'all');

        // Lọc danh sách nhà cung cấp dựa trên trạng thái phê duyệt
        $query = TbNhaCungCap::query();

        if ($filter === 'approved') {
            $query->where('pheDuyet', true);
        } elseif ($filter === 'pending') {
            $query->where('pheDuyet', false);
        }

        $suppliers = $query->get();

        return view('owner.supplier_management.index', compact('suppliers', 'filter'));
    }
    public function approve($id)
    {
        $supplier = TbNhaCungCap::findOrFail($id);
        $supplier->pheDuyet = true; // Cập nhật trạng thái phê duyệt
        $supplier->save();

        return redirect()->route('owner.supplier_management.index')
                     ->with('success', 'Nhà cung cấp đã được phê duyệt.');
    }
    public function show($id)
    {
        // Tìm nhà cung cấp theo ID
        $supplier = TbNhaCungCap::with(['TaiKhoan', 'chungNhans'])->findOrFail($id);

        // Lấy danh sách sản phẩm của nhà cung cấp
        $products = TbTinDangSanPham::where('maNCC', $id) // Lọc theo mã nhà cung cấp
            ->with(['hinhanhtindang' => function($query) {
                $query->take(1); // Lấy 1 hình ảnh đầu tiên
            }])
            ->get();

        // Truyền cả nhà cung cấp và sản phẩm vào view
        return view('owner.supplier_management.show', compact('supplier', 'products'));
    }
    
    public function submitOrderRequest(Request $request)
{
    try {
        DB::beginTransaction();

        // Lấy dữ liệu từ form
        $ngayNhanDuKien = now()->addDays(3);
        $tongTien = 0; 

        // Tạo yêu cầu nhập hàng
        $orderRequest = TbYeuCauNhapHang::create([
            'trangThaiYeuCau' => 'Chờ duyệt',
            'trangThaiThanhToan' => 'Thanh toán khi nhận hàng',
            'tongTien' => $tongTien,
            'ngayNhanDuKien' => $ngayNhanDuKien,
            'ngayNhanThucTe' => null,
        ]);

        // Lưu chi tiết yêu cầu
        foreach ($request->input('selected', []) as $maTin) {
            $product = TbTinDangSanPham::findOrFail($maTin);
            $soLuong = $request->input("quantity.$maTin");

            TbChiTietYeuCauNhapHang::create([
                'maYeuCau' => $orderRequest->maYeuCau,
                'maTin' => $maTin,
                'soLuongYeuCau' => $soLuong,
                'giaTien' => $product->giaSP * $soLuong,
            ]);

            $tongTien += $product->giaSP * $soLuong;
        }

        // Cập nhật tổng tiền
        $orderRequest->update(['tongTien' => $tongTien]);

        DB::commit();

        return redirect()->back()->with('success', 'Yêu cầu nhập hàng đã được gửi thành công.');
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Lỗi khi gửi yêu cầu nhập hàng: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
    }
}

}
