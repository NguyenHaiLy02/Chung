@extends('buyer.layouts.app')
@section('title', 'Trang cá nhân')
@section('content')
    <section class="sec-product-detail bg12 p-t-65 p-b-60">
        <div class="container">
            @php
                $user = \App\Models\TbTaiKhoan::where('taikhoan', session('username'))->first();
            @endphp

            <!-- Navigation Bar on the left -->
            <div class="nav-bar">
                <a href="{{ url('/profile') }}" id="profile-link"
                    class="{{ Request::is('profile') ? 'active-nav' : '' }}">Hồ Sơ</a>
                <a href="{{ url('/password') }}" id="password-link"
                    class="{{ Request::is('password') ? 'active-nav' : '' }}">Đổi Mật Khẩu</a>
                <a href="{{ url('/view') }}" id="view-link"
                    class="{{ Request::is('view') ? 'active-nav' : '' }}">Đơn mua</a>
            </div>
            

            <!-- Content Section on the right -->
            <section class="content-section">
                @yield('content1')
            </section>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var navLinks = document.querySelectorAll('.nav a');

            function setActiveLink(linkId) {
                navLinks.forEach(function(link) {
                    link.classList.remove('active');
                });
                var activeLink = document.getElementById(linkId);
                activeLink.classList.add('active');
                localStorage.setItem('activeLink', linkId);
            }

            navLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    setActiveLink(this.id);
                });
            });

            var savedActiveLink = localStorage.getItem('activeLink');
            if (savedActiveLink) {
                setActiveLink(savedActiveLink);
            }
        });
    </script>
@endsection
<style>
    .container {
        display: flex;
        justify-content: space-between;
    }

    .nav-bar {
        width: 25%;
        /* Tạo độ rộng cho thanh menu bên trái */
        padding-right: 30px;
    }

    a {
        display: block;
        /* Đảm bảo mỗi thẻ a chiếm một dòng */
        margin-bottom: 10px;
        /* Thêm khoảng cách dưới mỗi liên kết */
        padding: 10px;
        /* Thêm padding để dễ nhìn hơn */
        text-decoration: none;
        /* Bỏ gạch dưới */
        color: #000;
        /* Màu chữ */
        background-color: #f8f9fa;
        /* Màu nền */
        border: 1px solid #ddd;
        /* Viền nhẹ xung quanh */
        border-radius: 5px;
        /* Bo tròn góc */
        transition: background-color 0.3s ease;
        /* Hiệu ứng chuyển màu nền khi hover */
    }

    a:hover {
        background-color: #7bc548;
        /* Màu nền khi hover */
        color: white;
        /* Màu chữ khi hover */
    }

    a.active-nav {
    background-color: #7bc548;
    color: white;
    font-weight: bold;
    /* Đậm chữ để nổi bật */
    border: 1px solid #7bc548;
    /* Tăng độ tương phản */
}

    .content-section {
        width: 70%;
        /* Cung cấp không gian cho nội dung bên phải */
        padding-left: 30px;
    }

    /* Các điều chỉnh khi màn hình nhỏ hơn */
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
            /* Chuyển đổi từ bố trí ngang sang dọc */
        }

        .nav-bar {
            width: 100%;
            padding-right: 0;
        }

        .content-section {
            width: 100%;
            padding-left: 0;
        }
    }
</style>
