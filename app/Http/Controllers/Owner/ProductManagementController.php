<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\TbSanPham;
use App\Models\TbDanhMuc;
use App\Models\TbNhaCungCap;
use Illuminate\Http\Request;

class ProductManagementController extends Controller
{
    public function index()
    {
        $products = TbSanPham::with(['nhaCungCap', 'hinhAnhSps'])->get();
        return view('owner.product.index', compact('products'));
    }
    public function create()
    {
        $suppliers = TbNhaCungCap::all();
        $categories = TbDanhMuc::all();
        return view('owner.product.form', compact('suppliers', 'categories'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenSanPham' => 'required',
            'giaTien' => 'required|numeric',
            'maNCC' => 'required',
            'maDanhMuc' => 'required',
            'moTa' => 'nullable|string',  // Optional, but validated if present
            'cachBaoQuan' => 'nullable|string',  // Optional, but validated if present
            'donViTinh' => 'nullable|string',  // Optional, but validated if present
            'ngaySanXuat' => 'nullable|date',  // Optional, but validated if present
            'ngayHetHan' => 'nullable|date',  // Optional, but validated if present
            'soLuongTonKho' => 'nullable|integer',  // Optional, but validated if present
        ]);

        $product = TbSanPham::create($validated);
    
        if ($request->hasFile('hinhAnh')) {
            foreach ($request->file('hinhAnh') as $file) {
                $path = $file->store('products', 'public');
                $product->hinhAnhSps()->create(['hinhAnh' => $path]);
            }
        }
    
        return redirect()->route('owner.product.index')->with('success', 'Thêm sản phẩm thành công!');
    }
    public function edit($id)
    {
        $product = TbSanPham::with('hinhAnhSps')->findOrFail($id);
        $suppliers = TbNhaCungCap::all();
        $categories = TbDanhMuc::all();
    
        return view('owner.product.form', compact('product', 'suppliers', 'categories'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'tenSanPham' => 'required',
            'giaTien' => 'required|numeric',
            'maNCC' => 'required',
            'maDanhMuc' => 'required',
            'moTa' => 'nullable|string',
            'cachBaoQuan' => 'nullable|string',
            'donViTinh' => 'nullable|string',
            'ngaySanXuat' => 'nullable|date',
            'ngayHetHan' => 'nullable|date',
            'soLuongTonKho' => 'nullable|integer',
        ]);

        // Find the product by ID
        $product = TbSanPham::findOrFail($id);

        // Update the product with validated data
        $product->update($validated);

        // Handle image deletion
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = $product->hinhAnhSps()->find($imageId);
                if ($image) {
                    // Delete the image record from the database
                    $image->delete();
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('hinhAnh')) {
            foreach ($request->file('hinhAnh') as $file) {
                $path = $file->store('products', 'public');
                $product->hinhAnhSps()->create(['hinhAnh' => $path]);
            }
        }

        // Redirect with success message
        return redirect()->route('owner.product.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function destroy($id)
    {
        TbSanPham::destroy($id);
        return redirect()->route('owner.product.index')->with('success', 'Sản phẩm đã được xóa.');
    }
}
