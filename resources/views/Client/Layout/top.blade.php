<header class="market-header">
    <div class="market-header-top">
        <div class="container market-container">
            <div class="market-header-inner">
                <a href="/" class="market-brand">
                    <img src="/assets_client/images/logo.jpg" alt="Logo">
                    <div>
                        <strong>{{ setting('site_name') }}</strong>
                        <span>Marketplace BDS 2026</span>
                    </div>
                </a>

                <form class="market-header-search d-none d-lg-flex" role="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Tìm theo khu vực, dự án, đường phố...">
                </form>

                <div class="market-header-actions">
                    <a href="javascript:;" class="market-icon-btn d-none d-xl-inline-flex" aria-label="Wishlist">
                        <i class="fa-regular fa-heart"></i>
                    </a>
                    <a href="javascript:;" class="market-post-btn d-none d-xl-inline-flex">Đăng tin</a>
                    @if ($khach_hangLogin)
                        <div class="dropdown d-none d-xl-block">
                            <a href="javascript:;" class="market-user-btn dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa-regular fa-user"></i>
                                <span>{{ $khach_hangLogin->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/user/profile">Tài khoản</a></li>
                                <li><a class="dropdown-item" href="/user/logout">Đăng xuất</a></li>
                            </ul>
                        </div>
                    @else
                        <a href="/user/login" class="market-user-btn d-none d-xl-inline-flex">
                            <i class="fa-regular fa-user"></i>
                            <span>Đăng nhập</span>
                        </a>
                    @endif
                    <button class="market-mobile-toggle d-xl-none" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#mobileMenuCanvas" aria-controls="mobileMenuCanvas">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
