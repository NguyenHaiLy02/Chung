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
                <a href="{{ url('/profile') }}" id="profile-link" class="{{ Request::is('profile') ? 'active-nav' : '' }}">Hồ
                    Sơ</a>
                <a href="{{ url('/password') }}" id="password-link"
                    class="{{ Request::is('password') ? 'active-nav' : '' }}">Đổi Mật Khẩu</a>
                <a href="{{ url('/view') }}" id="view-link" class="{{ Request::is('view') ? 'active-nav' : '' }}">Đơn
                    mua</a>
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
    margin-top: 20px; /* Thêm khoảng cách phía trên */
}

.nav-bar {
    width: 25%;
    padding-right: 30px;
}

.nav-bar a {
    display: block;
    margin-bottom: 10px;
    padding: 10px;
    text-decoration: none;
    color: #000;
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.nav-bar a:hover {
    background-color: #7bc548;
    color: white;
}

.nav-bar a.active-nav {
    background-color: #7bc548;
    color: white;
    font-weight: bold;
    border: 1px solid #7bc548;
}

.content-section {
    width: 70%;
    padding-left: 30px;
}

/* Các điều chỉnh khi màn hình nhỏ hơn */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
        margin-top: 10px; /* Giảm khoảng cách cho màn hình nhỏ hơn */
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
