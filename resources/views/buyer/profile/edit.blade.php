@extends('buyer.layouts.app')
@section('title', 'Chỉnh Sửa Thông Tin')
@section('content')
    <div class="edit-profile-container"
        style="max-width: 600px; margin: auto; padding: 20px; background-color: #f9f9f9; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
        <h1 style="text-align: center; margin-bottom: 20px;">Chỉnh Sửa Thông Tin</h1>
        <form action="{{ route('profile.update', ['id' => $customer->maKhachHang]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <!-- Hiển thị ảnh đại diện -->
            <div style="text-align: center; margin-bottom: 20px;">
                @if ($customer->anhDaiDien)
                <img src="{{ asset('storage/' . $customer->anhDaiDien) }}" alt="Ảnh đại diện"
                style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 2px solid #ddd;">
            
                @else
                    <p id="current-avatar-message" style="color: #aaa;">Chưa có ảnh đại diện</p>
                @endif
            </div>

            <!-- Input Ảnh đại diện -->
            <div style="margin-bottom: 20px;">
                <label for="anhDaiDien" style="font-weight: bold;">Ảnh đại diện:</label>
                <input type="file" name="anhDaiDien" accept="image/*" onchange="previewImage(event)"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            <!-- Preview ảnh sau khi chọn -->
            <div id="image-preview-container" style="text-align: center; margin-bottom: 20px;">
                <img id="preview-avatar" src="" alt="Ảnh đại diện mới"
                    style="display: none; width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 2px solid #ddd;">
            </div> 

            <!-- Input Tên -->
            <div style="margin-bottom: 15px;">
                <label for="tenTaiKhoan" style="font-weight: bold;">Tên:</label>
                <input type="text" name="tenTaiKhoan" value="{{ $customer->tenTaiKhoan }}" required
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>

            <!-- Input Số điện thoại -->
            <div style="margin-bottom: 15px;">
                <label for="sdt" style="font-weight: bold;">Số điện thoại:</label>
                <input type="text" name="sdt" value="{{ $customer->sdt }}" required
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>

            <!-- Input Địa chỉ -->
            <div style="margin-bottom: 15px;">
                <label for="diaChi" style="font-weight: bold;">Địa chỉ:</label>
                <input type="text" name="diaChi" value="{{ $customer->diaChi }}" required
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>


            <!-- Buttons -->
            <div style="text-align: center;">
                <button type="submit" class="btn btn-success"
                    style="padding: 10px 20px; background-color: #28a745; border: none; color: white; border-radius: 5px; cursor: pointer;">Lưu</button>
                <a href="{{ route('profile') }}" class="btn btn-secondary"
                    style="padding: 10px 20px; background-color: #6c757d; border: none; color: white; border-radius: 5px; cursor: pointer; text-decoration: none; margin-left: 10px;">Hủy</a>
            </div>
        </form>
    </div>

    <script>
        // Hàm để xem trước ảnh khi chọn
        function previewImage(event) {
            var reader = new FileReader();
            var imagePreview = document.getElementById('preview-avatar');
            var imageContainer = document.getElementById('image-preview-container');

            reader.onload = function() {
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
                imageContainer.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
