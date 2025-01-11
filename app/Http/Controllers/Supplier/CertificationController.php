<?php
namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\TbChungNhan;
use App\Models\TbNhaCungCap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificationController extends Controller
{
    // Hiển thị thông tin nhà cung cấp và chứng nhận
    public function showCertifications()
    {
        $nhaCungCap = Auth::user(); // Lấy nhà cung cấp đang đăng nhập

        // Kiểm tra xem nhà cung cấp có đăng nhập và có mối quan hệ nhaCungCap không
        if (!$nhaCungCap || !$nhaCungCap->nhaCungCap) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem thông tin.');
        }

        $chungNhans = TbChungNhan::where('maNCC', $nhaCungCap->nhaCungCap->maNCC)->get(); // Lấy chứng nhận của nhà cung cấp

        return view('supplier.certification.index', compact('nhaCungCap', 'chungNhans'));
    }

    // Cập nhật thông tin nhà cung cấp và chứng nhận
    public function updateCertification(Request $request)
{
    $request->validate([
        'tenNCC' => 'required|string|max:255',
        'diaChi' => 'required|string|max:255',
        'sdt' => 'required|string|max:15',
        'xuatXu' => 'required|string|max:255',
        'hinhanh' => 'nullable|image|max:2048', // Chứng nhận có thể không cập nhật
        'delete' => 'nullable|array',  // Chứng nhận cần xóa
        'delete.*' => 'exists:tbchungnhan,id',  // Kiểm tra chứng nhận có tồn tại
    ]);

    $nhaCungCap = Auth::user(); // Lấy nhà cung cấp đang đăng nhập

    // Kiểm tra nếu không có nhà cung cấp đăng nhập hoặc maNCC không tồn tại
    if (!$nhaCungCap || !$nhaCungCap->nhaCungCap) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để cập nhật thông tin.');
    }

    // Cập nhật thông tin nhà cung cấp
    $nhaCungCap->nhaCungCap->update([
        'tenNCC' => $request->tenNCC,
        'diaChi' => $request->diaChi,
        'sdt' => $request->sdt,
        'xuatXu' => $request->xuatXu,
    ]);

    // Nếu có chứng nhận được chọn để xóa, xử lý xóa
    if ($request->has('delete') && is_array($request->input('delete'))) {
        $deleteIds = $request->input('delete');
        
        // Xóa hình ảnh từ storage
        $chungNhansToDelete = TbChungNhan::whereIn('id', $deleteIds)->get();
        foreach ($chungNhansToDelete as $chungNhan) {
            if (Storage::exists('public/' . $chungNhan->hinhanh)) {
                Storage::delete('public/' . $chungNhan->hinhanh);
            }
        }
    
        // Xóa chứng nhận khỏi cơ sở dữ liệu
        TbChungNhan::whereIn('id', $deleteIds)->delete();
    }
    

    // Nếu có hình ảnh chứng nhận mới, xử lý và cập nhật
    if ($request->hasFile('hinhanh')) {
        // Xử lý hình ảnh và lưu vào thư mục chungnhan trong storage
        $imagePath = $request->file('hinhanh')->store('chungnhan', 'public');

        // Lưu chứng nhận mới vào cơ sở dữ liệu
        TbChungNhan::create([
            'maNCC' => $nhaCungCap->nhaCungCap->maNCC, // Đảm bảo rằng maNCC có giá trị
            'hinhanh' => $imagePath,
        ]);
    }

    return redirect()->route('supplier.certifications')->with('success', 'Thông tin đã được cập nhật!');
}

}


