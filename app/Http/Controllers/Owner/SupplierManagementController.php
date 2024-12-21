<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\TbNhaCungCap;
use Illuminate\Http\Request;

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

        return view('owner.supplier_management.show', compact('supplier'));
    }
}
