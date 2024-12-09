<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\TbDanhMuc;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Hiển thị danh sách danh mục.
     */
    public function index()
    {
        $categories = TbDanhMuc::all();
        return view('owner.category.index', compact('categories'));
    }

    /**
     * Hiển thị form tạo danh mục mới.
     */
    public function create()
    {
        return view('owner.category.create');
    }

    /**
     * Lưu danh mục mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tenDanhMuc' => 'required|string|max:255',
            'moTa' => 'nullable|string|max:500',
        ]);

        TbDanhMuc::create($request->only(['tenDanhMuc', 'moTa']));

        return redirect()->route('owner.category.index')->with('success', 'Danh mục đã được thêm thành công.');
    }

    /**
     * Hiển thị form chỉnh sửa danh mục.
     */
    public function edit($id)
    {
        $category = TbDanhMuc::findOrFail($id);
        return view('owner.category.edit', compact('category'));
    }

    /**
     * Cập nhật thông tin danh mục.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tenDanhMuc' => 'required|string|max:255',
            'moTa' => 'nullable|string|max:500',
        ]);

        $category = TbDanhMuc::findOrFail($id);
        $category->update($request->only(['tenDanhMuc', 'moTa']));

        return redirect()->route('owner.category.index')->with('success', 'Danh mục đã được cập nhật thành công.');
    }

    /**
     * Xóa danh mục khỏi cơ sở dữ liệu.
     */
    public function destroy($id)
    {
        $category = TbDanhMuc::findOrFail($id);

        // Kiểm tra xem danh mục có sản phẩm liên quan hay không
        if ($category->sanPhams()->count() > 0) {
            return redirect()->route('owner.category.index')->with('error', 'Không thể xóa danh mục có sản phẩm liên quan.');
        }

        $category->delete();
        return redirect()->route('owner.category.index')->with('success', 'Danh mục đã được xóa thành công.');
    }
}