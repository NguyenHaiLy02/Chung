<?php
namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\TbYeuCauNhapHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductExportManagementController extends Controller
{
    public function index()
    {
        // Lấy thông tin yêu cầu nhập hàng liên quan đến nhà cung cấp hiện tại
        $requests = TbYeuCauNhapHang::with(['chiTietYeuCau.tinDangSanPham'])
            ->whereHas('chiTietYeuCau.tinDangSanPham.nhaCungCap', function ($query) {
                $query->where('maNCC', Auth::user()->nhaCungCap->maNCC);
            })
            ->get();
    
        // Trả về view với danh sách yêu cầu nhập hàng
        return view('supplier.product_export_management.index', compact('requests'));
    }
    public function show($id)
    {
        // Lấy yêu cầu nhập hàng cùng các chi tiết liên quan
        $orderRequest = TbYeuCauNhapHang::with(['chiTietYeuCau.tinDangSanPham.hinhanhtindang'])
            ->findOrFail($id);

        // Trả về view chi tiết yêu cầu nhập hàng
        return view('supplier.product_export_management.show', compact('orderRequest'));
    }

    public function updateStatus($id)
    {
        try {
            $requestOrder = TbYeuCauNhapHang::findOrFail($id);

            if ($requestOrder->trangThaiYeuCau == 'Đã duyệt') {
                $requestOrder->trangThaiYeuCau = 'Đã nhận hàng';
                $requestOrder->ngayNhanThucTe = now();
                $requestOrder->save();

                return redirect()->route('owner.product_import_request.index')
                    ->with('success', 'Trạng thái yêu cầu đã được cập nhật.');
            } else {
                $requestOrder->trangThaiYeuCau = 'Đã duyệt';
                $requestOrder->save();

                foreach ($requestOrder->chiTietYeuCau as $detail) {
                    $product = $detail->tinDangSanPham;

                    if ($detail->soLuongYeuCau > $product->soLuong) {
                        $requestOrder->trangThaiYeuCau = 'Số lượng không đủ';
                        $requestOrder->save();

                        return redirect()->route('supplier.product_export_management.index')
                            ->with('error', 'Số lượng yêu cầu vượt quá số lượng hiện có của sản phẩm.');
                    }

                    $product->soLuong -= $detail->soLuongYeuCau;
                    $product->save();
                }

                return redirect()->route('supplier.product_export_management.index')
                    ->with('success', 'Trạng thái yêu cầu đã được cập nhật.');
            }

        } catch (\Exception $e) {
            // Nếu có lỗi, trả về thông báo lỗi
            return redirect()->route('supplier.product_export_management.index')
                ->with('error', 'Có lỗi xảy ra khi cập nhật trạng thái.');
        }
    }

}
