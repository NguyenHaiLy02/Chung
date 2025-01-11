<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #161b2c">
    <div class="logo">
        <a href="{{ route('dashboard.index') }}"><img src="{{ asset('images/logo.jpg') }}" alt="Logo"
                class="img-fluid"></a>
    </div>
    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            @if (session('username'))
                @php
                    $user = \App\Models\TbTaiKhoan::where('taiKhoan', session('username'))->first();
                @endphp
                <div class="image">
                    <img src="https://png.pngtree.com/png-vector/20191125/ourmid/pngtree-beautiful-admin-roles-line-vector-icon-png-image_2035379.jpg"
                        class="img-circle elevation-2" alt="Shop Image" style="width: 30px; height: 30px">
                </div>
                <div class="info">
                    <h6 href="" class="d-block text-white">{{ $user->taiKhoan }}</h6>
                </div>
            @endif
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search"
                    style="background-color: #161b2c">
                <div class="input-group-append">
                    <button class="btn btn-sidebar" style="background-color: #161b2c">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @if (session('username') && $user->quyen === 'chucuahang')
                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}" class="nav-link text-white">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                @endif
                @if (session('username') && $user->quyen === 'chucuahang')
                    <li class="nav-item">
                        <a href="{{ route('owner.customer_management.index') }}" class="nav-link text-white">
                            <i class="nav-icon fas fa-user"></i>
                            <p> Quản lý khách hàng </p>
                        </a>
                    </li>
                @endif
                @if (session('username') && $user->quyen === 'chucuahang')
                    <li class="nav-item">
                        <a href="{{ route('owner.employee_management.index') }}" class="nav-link text-white">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p> Quản lý nhân viên </p>
                        </a>
                    </li>
                @endif
                @if (session('username') && $user->quyen === 'chucuahang')
                    <li class="nav-item">
                        <a href="{{ route('owner.supplier_management.index') }}" class="nav-link text-white">
                            <i class="nav-icon fas fa-warehouse"></i>
                            <p> Nhà cung cấp </p>
                        </a>
                    </li>
                @endif
                @if (session('username') && $user->quyen === 'chucuahang')
                    <li class="nav-item">
                        <a href="{{ route('owner.category.index') }}" class="nav-link text-white">
                            <i class="nav-icon fas fa-bars"></i>
                            <p> Danh Mục</p>
                        </a>
                    </li>
                @endif
                @if (auth()->check() && in_array(auth()->user()->quyen, ['chucuahang', 'nhanvien']))
                    <li class="nav-item">
                        <a href="{{ route('owner.product.index') }}" class="nav-link text-white">
                            <i class="nav-icon fas fa-tag"></i>
                            <p> Sản phẩm </p>
                        </a>
                    </li>
                @endif
                @if (auth()->check() && in_array(auth()->user()->quyen, ['chucuahang', 'nhanvien', 'nhanviengiaohang']))
                    <li class="nav-item">
                        <a href="{{ route('owner.orders') }}" class="nav-link text-white">
                            <i class="nav-icon fas fa-receipt"></i>
                            <p> Quản lý đơn hàng </p>
                        </a>
                    </li>
                @endif
                @if (session('username') && $user->quyen === 'chucuahang')
                    <li class="nav-item">
                        <a href="/owner/product_import_request" class="nav-link text-white">
                            <i class="nav-icon fas fa-history"></i>
                            <p> Yêu cầu nhập hàng </p>
                        </a>
                    </li>
                @endif

                @if (session('username') && $user->quyen === 'nhacungcap')
                    <li class="nav-item">
                        <a href="/supplier/post_product" class="nav-link text-white">
                            <i class="nav-icon fas fa-edit"></i> <!-- Icon chỉnh sửa -->
                            <p> Đăng tin sản phẩm </p>
                        </a>
                    </li>
                @endif
                @if (session('username') && $user->quyen === 'nhacungcap')
                    <li class="nav-item">
                        <a href="/supplier/product_export_management" class="nav-link text-white">
                            <i class="nav-icon fas fa-shipping-fast"></i> <!-- Icon giao hàng nhanh -->
                            <p> Quản lý xuất hàng </p>
                        </a>
                    </li>
                @endif
                @if (session('username') && $user->quyen === 'nhacungcap')
                    <li class="nav-item">
                        <a href="/supplier/certifications" class="nav-link text-white">
                            <i class="nav-icon fas fa-user-edit"></i> <!-- Icon giao hàng nhanh -->
                            <p> Cập nhật thông tin</p>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
