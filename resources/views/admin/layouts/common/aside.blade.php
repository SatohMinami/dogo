
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            </div>
            <div class="info">
                <a href="{{ route('admin.home') }}" class="d-block">ĐỒ GỖ CƯƠNG HẰNG</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                {{--                    <li class="nav-item">--}}
                {{--                        <a href="{{ route('admin.category.index') }}" class="nav-link">--}}
                {{--                            <i class="nav-icon fas fa-th"></i>--}}
                {{--                            <p>--}}
                {{--                                Quản Lý Thể Loại--}}
                {{--                            </p>--}}
                {{--                        </a>--}}
                {{--                    </li>--}}
                {{--                    <li class="nav-item">--}}
                {{--                        <a href="{{ route('admin.brand.index') }}" class="nav-link">--}}
                {{--                            <i class="nav-icon fas fa-th"></i>--}}
                {{--                            <p>--}}
                {{--                                Quản Lý Nhãn Hàng--}}
                {{--                            </p>--}}
                {{--                        </a>--}}
                {{--                    </li>--}}
                <li class="nav-item">
                    <a href="{{ route('admin.product.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Quản Lý Sản Phẩm
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

