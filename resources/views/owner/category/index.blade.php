@extends('owner.layouts.app')

@section('title', 'Danh sách danh mục')

@section('content')
    <div class="container mt-0">
        <h2 class="text-center mb-0">Danh sách danh mục</h2>
        <div class="text-end mb-2">
            <a href="{{ route('owner.category.create') }}" class="btn btn-primary">Thêm danh mục mới</a>
        </div>

        @if ($categories->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $category->tenDanhMuc }}</td>
                                <td>{{ $category->moTa ?? 'Không có mô tả' }}</td>
                                <td>
                                    <a href="{{ route('owner.category.edit', $category->maDanhMuc) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('owner.category.destroy', $category->maDanhMuc) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center">Không có danh mục nào được tìm thấy.</p>
        @endif
    </div>
@endsection
