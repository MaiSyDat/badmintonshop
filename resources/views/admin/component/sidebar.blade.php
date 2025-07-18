<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" class="app-brand-link">
            <span class="app-brand-text fw-bolder fs-3">BadmintonShop</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        @auth
            @if (Auth::user()->isAdmin())
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-server"></i>
                        <div data-i18n="Layouts">Quản lý hệ thống</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('admin.roles.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Quản lý Phân quyền</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.account.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Quản lý Người dùng</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.categories.index') }}" class="menu-link">
                                <div data-i18n="Without navbar">Quản lý Danh mục</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.brands.index') }}" class="menu-link">
                                <div data-i18n="Without navbar">Quản lý Thương hiệu</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-store"></i>
                    <div data-i18n="Layouts">Quản lý Cửa hàng</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('admin.product.index') }}" class="menu-link">
                            <div data-i18n="Container">Quản lý Sản phẩm</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.coupon.index') }}" class="menu-link">
                            <div data-i18n="Fluid">Quản lý Mã giảm giá</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.orders.index') }}" class="menu-link">
                            <div data-i18n="Blank">Quản lý Đơn hàng</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.reviews.index') }}" class="menu-link">
                            <div data-i18n="Blank">Quản lý Đánh giá</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endauth
    </ul>
</aside>
