<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    <img src="{{ asset("frontend/images/Logo/Email.svg") }}" alt="Email" width="13" height="17">
                    <span class="px-2">dogocuonghang131@gmail.com</span>
                    <span class="px-3">|</span>
                    <img src="{{ asset("frontend/images/Logo/Địa chỉ.svg") }}" alt="Email" width="13" height="17">
                    <span class="px-2">Ngõ 163 Đại Mỗ, Nam Từ Liêm, Hà Nội</span>
                </div>

                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        TRANG CHỦ
                    </a>

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        LIÊN HỆ | GIỚI THIỆU
                    </a>
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">
                <a href="{{ route('front.home') }}" class="logo">
                    <img src="{{ asset("frontend/images/Logo/Group3098.svg") }}" alt="IMG-LOGO" width="550px" height="400px">
                </a>
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <input type="text" placeholder="Tìm Kiếm" class="input-search form-control">
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="{{ route('front.home') }}"><img src="{{ asset("frontend/images/Logo/Group3098.svg") }}" class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search" width="550px" height="400px" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

{{--            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">--}}
{{--                <i class="zmdi zmdi-shopping-cart"></i>--}}
{{--            </div>--}}

{{--            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">--}}
{{--                <i class="zmdi zmdi-favorite-outline"></i>--}}
{{--            </a>--}}
        </div>
    </div>
</header>
