@extends('owner.layouts.app')

@section('title', 'Thêm danh mục mới')

@section('content')
    <div class="container my-4">
        <h2 class="text-center mb-4">Thêm danh mục mới</h2>

        <form action="{{ route('owner.category.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="tenDanhMuc" class="form-label">Tên danh mục</label>
                <input type="text" name="tenDanhMuc" id="tenDanhMuc" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="moTa" class="form-label">Mô tả</label>
                <textarea name="moTa" id="moTa" class="form-control" rows="4"></textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                <a href="{{ route('owner.category.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
@endsection
