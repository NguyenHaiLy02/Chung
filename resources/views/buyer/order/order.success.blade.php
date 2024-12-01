@extends('layouts.app')

@section('content')
<div class="order-success" style="text-align: center; padding: 20px;">
    <h1>Đặt hàng thành công!</h1>
    <p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!</p>
    <a href="{{ route('home') }}" style="text-decoration: none; color: white; background-color: #3498db; padding: 10px 20px; border-radius: 5px;">Quay lại trang chủ</a>
</div>
@endsection
