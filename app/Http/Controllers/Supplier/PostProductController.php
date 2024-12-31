<?php
namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\TbTinDangSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostProductController extends Controller
{
    // Hiển thị danh sách sản phẩm của nhà cung cấp đang đăng nhập
    public function index()
    {
        // Lấy danh sách sản phẩm của nhà cung cấp đang đăng nhập và eager load hình ảnh đầu tiên từ bảng tbHinhAnhTinDang
        $products = TbTinDangSanPham::where('maNCC', Auth::user()->nhaCungCap->maNCC) // Lọc theo mã nhà cung cấp
            ->with(['hinhanhtindang' => function($query) {
                $query->take(1); // Lấy 1 hình ảnh đầu tiên
            }])
            ->get();

        // Trả về view với dữ liệu sản phẩm
        return view('supplier.post_product.index', compact('products'));
    }

    // Thêm sản phẩm mới
    public function create()
    {
        return view('supplier.post_product.create'); // View thêm sản phẩm (chưa triển khai)
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'tenSP' => 'required|string|max:255',
            'moTa' => 'nullable|string',
            'giaSP' => 'required|numeric',
            'donViTinh' => 'required|string|max:50',
            'ngaySanXuat' => 'required|date',
            'ngayHetHan' => 'required|date',
            'soLuong' => 'required|integer',
            'hinhanh' => 'nullable|array', // Đảm bảo đây là mảng nếu upload nhiều file
            'hinhanh.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Lưu thông tin sản phẩm vào bảng tbTinDangSanPham
        $product = TbTinDangSanPham::create([
            'maNCC' => auth()->user()->nhaCungCap->maNCC, // Lấy mã nhà cung cấp từ người dùng đã đăng nhập
            'tenSP' => $request->tenSP,
            'moTa' => $request->moTa,
            'giaSP' => $request->giaSP,
            'donViTinh' => $request->donViTinh,
            'ngaySanXuat' => $request->ngaySanXuat,
            'ngayHetHan' => $request->ngayHetHan,
            'soLuong' => $request->soLuong,
        ]);
    
        if ($request->hasFile('hinhanh')) {
            foreach ($request->file('hinhanh') as $file) {
                // Lưu file vào storage và lấy đường dẫn
                $path = $file->store('post_products', 'public');
    
                // Lưu đường dẫn hình ảnh vào bảng product_images (nếu có)
                $product->images()->create([
                    'path' => $path,
                ]);
            }
        }
    
        return redirect()->route('supplier.post_product.index')->with('success', 'Sản phẩm đã được đăng thành công!');
    }

    public function edit($id)
    {
        $product = TbTinDangSanPham::findOrFail($id);
        return view('supplier.post_product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'tenSP' => 'required|string|max:255',
        'moTa' => 'nullable|string',
        'giaSP' => 'required|numeric',
        'donViTinh' => 'required|string|max:50',
        'ngaySanXuat' => 'required|date',
        'ngayHetHan' => 'required|date',
        'soLuong' => 'required|integer',
        'hinhanh' => 'nullable|array',
        'hinhanh.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $product = TbTinDangSanPham::findOrFail($id);
    $product->update($request->all());  // Cập nhật thông tin sản phẩm

    // Kiểm tra nếu có tệp tải lên
    if ($request->hasFile('hinhanh')) {
        foreach ($request->file('hinhanh') as $file) {
            // Kiểm tra xem có phải là đối tượng của UploadedFile không
            if ($file instanceof \Illuminate\Http\UploadedFile) {
                // Lưu tệp vào thư mục public
                $path = $file->store('post_products', 'public');
                // Tạo bản ghi mới trong bảng 'tbhinhanhtindang' để lưu đường dẫn hình ảnh
                $product->hinhanhtindang()->create(['hinhAnh' => $path]);
            }
        }
    }

    return redirect()->route('supplier.post_product.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
}

    public function destroy($id)
    {
        $product = TbTinDangSanPham::findOrFail($id);
        $product->delete();

        // Xóa hình ảnh liên quan nếu có
        $product->hinhanhtindang()->delete();

        return redirect()->route('supplier.post_product.index')->with('success', 'Sản phẩm đã được xóa thành công!');
    }

}
