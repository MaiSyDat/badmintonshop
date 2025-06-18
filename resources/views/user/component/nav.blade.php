<header class="header">

    {{-- Nav main --}}
    <nav class="nav grid wide">

        {{-- logo and menu mobile --}}
        <div class="nav__data">
            <a href="{{ route('home') }}" class="nav__logo">
                Badminton<span>Shop</span>
            </a>
            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-menu nav__toggle-menu'></i>
                <i class='bx bx-x nav__toggle-close'></i>
            </div>
        </div>

        {{-- nav  --}}
        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li>
                    <a href="{{ route('home') }}" class="nav__link">Trang chủ</a>
                </li>

                <li class="dropdown__item">
                    <div class="nav__link dropdown__button">
                        Sản phẩm <i class='bx bx-chevron-down dropdown__arrow'></i>
                    </div>
                    {{-- menu dropdown --}}
                    <div class="dropdown__container">
                        <div class="dropdown__content">
                            <div class="dropdown__group">
                                <span class="dropdown__title">Title</span>
                                <ul class="dropdown__list">
                                    <li>
                                        <a href="#" class="dropdown__link">product</a>
                                    </li>

                                    <li>
                                        <a href="#" class="dropdown__link">product</a>
                                    </li>

                                    <li>
                                        <a href="#" class="dropdown__link">product</a>
                                    </li>

                                    <li>
                                        <a href="#" class="dropdown__link">product</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown__group">
                                <span class="dropdown__title">Title</span>
                                <ul class="dropdown__list">
                                    <li>
                                        <a href="#" class="dropdown__link">product</a>
                                    </li>

                                    <li>
                                        <a href="#" class="dropdown__link">product</a>
                                    </li>

                                    <li>
                                        <a href="#" class="dropdown__link">product</a>
                                    </li>

                                    <li>
                                        <a href="#" class="dropdown__link">product</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown__group">
                                <span class="dropdown__title">Title</span>
                                <ul class="dropdown__list">
                                    <li>
                                        <a href="#" class="dropdown__link">product</a>
                                    </li>

                                    <li>
                                        <a href="#" class="dropdown__link">product</a>
                                    </li>

                                    <li>
                                        <a href="#" class="dropdown__link">product</a>
                                    </li>

                                    <li>
                                        <a href="#" class="dropdown__link">product</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="">
                    <div class="nav__link">
                        Tin tức
                    </div>
                </li>

                <li class="">
                    <div class="nav__link">
                        Giới thiệu
                    </div>
                </li>

                <li>
                    <a href="" class="nav__link">Liên hệ</a>
                </li>
            </ul>
        </div>

        <div class="nav__actions">
            <i class="bx bx-search nav__search" id="search-btn"></i>

            @auth
                <div class="droppdown__action">
                    @php
                        $user = Auth::user();
                        $initials = '';
                        if ($user && $user->full_name) {
                            $nameParts = explode(' ', $user->full_name);
                            foreach ($nameParts as $part) {
                                $initials .= strtoupper(substr($part, 0, 1));
                            }
                        } elseif ($user) {
                            $initials = strtoupper(substr($user->username, 0, 2));
                        } else {
                            $initials = 'NA'; // trường hợp không có user đăng nhập
                        }
                        $initials = substr($initials, 0, 2);
                    @endphp

                    <div class="user-avatar">
                        {{ $initials }}
                    </div>

                    <div class="dropdown__action-container">
                        <div class="dropdown__action-content">
                            <ul class="action__list">
                                <li>
                                    <a href="#" class="action__link">
                                        <i class="bx bx-user-circle"></i> Trang cá nhân
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="action__link">
                                        <i class="bx bx-cog"></i> Cài đặt
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="action__link">
                                        <i class="bx bx-cart"></i> Giỏ hàng
                                    </a>
                                </li>

                                @if (Auth::user()->isAdmin())
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}" class="action__link">
                                            <i class="bx bx-server"></i> Quản lý hệ thống</a>
                                    </li>
                                @elseif (Auth::user()->isStaff())
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}" class="action__link">
                                            <i class="bx bx-store"></i> Quản lý cửa hàng</a>
                                    </li>
                                @endif

                                <li><a href="{{ route('logout') }}" class="action__link"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bx bx-run"></i> Đăng xuất
                                    </a>
                                </li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            @else
                <div class="droppdown__action">
                    <i class="bx bx-user-circle nav__user"></i>

                    <div class="dropdown__action-container">
                        <div class="dropdown__action-content">
                            <ul class="action__list">
                                <li>
                                    <a href="{{ route('login') }}" class="action__link">
                                        <i class="bx bx-user"></i> Đăng nhập
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}" class="action__link">
                                        <i class="bx bx-scan"></i> Đăng ký
                                    </a>
                                </li>
                                <li><a href="#" class="action__link">
                                        <i class="bx bx-group"></i> Hỗ trợ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endauth
        </div>

    </nav>
</header>

<div class="search" id="search">
    <form action="" class="search__form">
        <i class="bx bx-search search__icon"></i>
        <input type="search" class="search__input" placeholder="Bạn cần tìm gì hôm nay?">
    </form>

    <i class="bx bx-x search__close" id="search-close"></i>
</div>
