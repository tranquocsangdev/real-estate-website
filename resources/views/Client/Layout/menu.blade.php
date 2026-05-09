<div class="market-navbar-wrap">
    <div class="container market-container">
        <nav class="market-navbar d-none d-xl-flex">
            <a href="/" class="market-nav-link active">Trang chủ</a>
            @foreach ($ds_menu as $value)
                @if (count($value['subcategories']) > 0)
                    <div class="dropdown">
                        <a href="javascript:;" class="market-nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            {{ $value['name'] }}
                        </a>
                        <ul class="dropdown-menu market-dropdown">
                            @foreach ($value['subcategories'] as $subvalue)
                                <li>
                                    <a class="dropdown-item" href="/home/category/{{ $subvalue['sub_slug'] }}">
                                        {{ $subvalue['sub_name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endforeach
            <a href="/home/all-post" class="market-nav-link">Tin mới đăng</a>
            <a href="javascript:;" class="market-nav-link">Dự án nổi bật</a>
            <a href="javascript:;" class="market-nav-link">Wiki BĐS</a>
        </nav>
    </div>

    <div class="offcanvas offcanvas-start market-offcanvas" tabindex="-1" id="mobileMenuCanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">{{ setting('site_name') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <a href="/" class="market-mobile-link">Trang chủ</a>
            <div class="accordion market-mobile-accordion" id="mobileMenuAccordion">
                @foreach ($ds_menu as $value)
                    @if (count($value['subcategories']) > 0)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $loop->index }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $loop->index }}" aria-expanded="false"
                                    aria-controls="collapse{{ $loop->index }}">
                                    {{ $value['name'] }}
                                </button>
                            </h2>
                            <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse"
                                aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#mobileMenuAccordion">
                                <div class="accordion-body">
                                    @foreach ($value['subcategories'] as $subvalue)
                                        <a href="/home/category/{{ $subvalue['sub_slug'] }}">{{ $subvalue['sub_name'] }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <a href="/home/all-post" class="market-mobile-link">Tin mới đăng</a>
            <a href="javascript:;" class="market-mobile-link">Đăng tin</a>

            <div class="market-mobile-group mt-2">
                <p>Tài khoản</p>
                @if ($khach_hangLogin)
                    <div class="d-flex gap-2 mt-2">
                        <a href="/user/profile" class="market-mobile-auth">Tài khoản</a>
                        <a href="/user/logout" class="market-mobile-auth alt">Đăng xuất</a>
                    </div>
                @else
                    <div class="d-flex gap-2 mt-2">
                        <a href="/user/login" class="market-mobile-auth">Đăng nhập</a>
                        <a href="/user/register" class="market-mobile-auth alt">Đăng ký</a>
                    </div>
                @endif
            </div>

            <div class="market-mobile-group mt-3">
                <p>Khác</p>
                <div class="d-flex gap-2 mt-2">
                    <a href="javascript:;" class="market-mobile-auth alt w-100 text-center">Wishlist</a>
                </div>
            </div>
        </div>
    </div>
</div>
