@extends('owner.layouts.app')

@section('title', 'Chỉnh sửa danh mục')

@section('content')
    <div class="container my-4">
        <h2 class="text-center mb-4">Chỉnh sửa danh mục</h2>

        <form action="{{ route('owner.category.update', $category->maDanhMuc) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="tenDanhMuc" class="form-label">Tên danh mục</label>
                <input type="text" name="tenDanhMuc" id="tenDanhMuc" class="form-control"
                    value="{{ $category->tenDanhMuc }}" required>
            </div>

            <div class="mb-3">
                <label for="moTa" class="form-label">Mô tả</label>
                <textarea name="moTa" id="moTa" class="form-control" rows="4">{{ $category->moTa }}</textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('owner.category.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
@endsection
