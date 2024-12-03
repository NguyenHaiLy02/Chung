@extends('buyer.profile.index')
@section('title', 'Đổi Mật Khẩu')
@section('content1')
<style>
    .password-container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        margin-left: 20px; /* Dịch container qua trái */
    }

    .password-container h1 {
        text-align: center;
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .password-container label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }

    .password-container input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .password-container button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .password-container button:hover {
        background-color: #0056b3;
    }

    .alert {
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        font-size: 14px;
        text-align: center;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>
<div class="password-container">
    <h1>Đổi Mật Khẩu</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <form action="{{ route('password.change') }}" method="POST">
        @csrf
        <label for="current-password">Mật khẩu hiện tại:</label>
        <input type="password" name="current_password" id="current-password" required>
        <label for="new-password">Mật khẩu mới:</label>
        <input type="password" name="new_password" id="new-password" required>
        <label for="new-password-confirmation">Nhập lại mật khẩu mới:</label>
        <input type="password" name="new_password_confirmation" id="new-password-confirmation" required>
        <button type="submit">Cập Nhật</button>
    </form>
</div>
@endsection
