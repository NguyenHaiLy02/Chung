@extends('owner.layouts.app')

@section('content')
    <div class="container">
        <h2>Cập nhật thông tin nhà cung cấp và chứng nhận</h2>

        <!-- Hiển thị thông tin nhà cung cấp -->
        <form action="{{ route('supplier.updateCertifications') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        
            <!-- Tên nhà cung cấp -->
            <div class="form-group">
                <label for="tenNCC">Tên nhà cung cấp</label>
                <input type="text" class="form-control" name="tenNCC" value="{{ old('tenNCC', $nhaCungCap->nhaCungCap->tenNCC) }}" required>
            </div>
        
            <!-- Địa chỉ -->
            <div class="form-group">
                <label for="diaChi">Địa chỉ</label>
                <input type="text" class="form-control" name="diaChi" value="{{ old('diaChi', $nhaCungCap->nhaCungCap->diaChi) }}" required>
            </div>
        
            <!-- Số điện thoại -->
            <div class="form-group">
                <label for="sdt">Số điện thoại</label>
                <input type="text" class="form-control" name="sdt" value="{{ old('sdt', $nhaCungCap->nhaCungCap->sdt) }}" required>
            </div>
        
            <!-- Xuất xứ -->
            <div class="form-group">
                <label for="xuatXu">Xuất xứ</label>
                <input type="text" class="form-control" name="xuatXu" value="{{ old('xuatXu', $nhaCungCap->nhaCungCap->xuatXu) }}" required>
            </div>
        
            <!-- Hình ảnh chứng nhận -->
            <div class="form-group">
                <label for="hinhanh">Chứng nhận (Hình ảnh)</label>
                <input type="file" class="form-control" name="hinhanh">
            </div>
        
            <h3>Chứng nhận của nhà cung cấp</h3>
            
            <!-- Hiển thị chứng nhận theo hàng ngang -->
            <div class="row">
                @foreach ($chungNhans as $chungNhan)
                    <div class="col-md-3 mb-3 text-center">
                        <img src="{{ asset('storage/' . $chungNhan->hinhanh) }}" alt="Chứng nhận" class="img-fluid rounded" style="max-width: 100%;">
        
                        <!-- Thêm checkbox chọn xóa -->
                        <div>
                            <input type="checkbox" name="delete[]" value="{{ $chungNhan->maChungNhan }}" id="delete_{{ $chungNhan->maChungNhan }}">
                            <label for="delete_{{ $chungNhan->maChungNhan }}">Xóa</label>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Nút cập nhật ở dưới cùng -->
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>        
    </div>
@endsection
