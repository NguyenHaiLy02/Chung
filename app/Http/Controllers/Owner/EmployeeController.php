<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\TbNhanVien;
use App\Models\TbTaiKhoan;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = TbNhanVien::with('taiKhoan')->get(); 
        return view('owner.employee_management.index', compact('employees'));
    }

    
    public function create()
    {
        return view('owner.employee_management.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'taiKhoan' => 'required|unique:tbtaikhoan,taiKhoan',
            'matKhau' => 'required|min:6',
            'email' => 'required|email|unique:tbtaikhoan,email',
            'hoTen' => 'required',
            'chucVu' => 'required',
        ]);

        $account = TbTaiKhoan::create([
            'taiKhoan' => $request->taiKhoan,
            'matKhau' => bcrypt($request->matKhau),
            'email' => $request->email,
            'quyen' => 'nhanvien',
            'verify_email' => true,
        ]);

        TbNhanVien::create([
            'taiKhoan' => $account->taiKhoan,
            'hoTen' => $request->hoTen,
            'chucVu' => $request->chucVu,
            'ngaySinh' => $request->ngaySinh,
            'cccd' => $request->cccd,
            'sdt' => $request->sdt,
            'diachi' => $request->diachi,
        ]);

        return redirect()->route('owner.employee_management.index')->with('success', 'Thêm nhân viên thành công.');
    }

    public function edit($id)
    {
        $employee = TbNhanVien::with('taiKhoan')->findOrFail($id);
        return view('owner.employee_management.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = TbNhanVien::findOrFail($id);
        $account = TbTaiKhoan::where('taiKhoan', $employee->taiKhoan)->first();

        $request->validate([
            'email' => 'required|email|unique:tbtaikhoan,email,' . $account->taiKhoan . ',taiKhoan',
            'hoTen' => 'required',
            'chucVu' => 'required',
        ]);

        // Cập nhật tài khoản
        $account->update([
            'email' => $request->email,
            'matKhau' => $request->matKhau ? bcrypt($request->matKhau) : $account->matKhau,
        ]);

        // Cập nhật nhân viên
        $employee->update([
            'hoTen' => $request->hoTen,
            'chucVu' => $request->chucVu,
            'ngaySinh' => $request->ngaySinh,
            'cccd' => $request->cccd,
            'sdt' => $request->sdt,
            'diachi' => $request->diachi,
        ]);

        return redirect()->route('owner.employee_management.index')->with('success', 'Cập nhật nhân viên thành công.');
    }

    // Xóa nhân viên
    public function destroy($id)
    {
        $employee = TbNhanVien::findOrFail($id);
        $account = TbTaiKhoan::where('taiKhoan', $employee->taiKhoan)->first();

        // Xóa cả tài khoản và thông tin nhân viên
        $employee->delete();
        $account->delete();

        return redirect()->route('owner.employee_management.index')->with('success', 'Xóa nhân viên thành công.');
    }
}
