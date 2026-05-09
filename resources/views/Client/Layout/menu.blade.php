<div class="market-navbar-wrap">
    @php
        $isHomeActive = request()->path() === '/' || request()->path() === '';
    @endphp

    <div class="container market-container">
        <nav class="market-navbar d-none d-xl-flex">
            <div class="market-nav-group">
                <a href="/" class="market-nav-link {{ $isHomeActive ? 'active' : '' }}">
                    <span>Trang chủ</span>
                </a>
            </div>
            @foreach ($ds_menu as $value)
                @if (count($value['subcategories']) > 0)
                    @php
                        $isParentActive = false;
                        foreach ($value['subcategories'] as $subvalue) {
                            if (request()->is('home/category/' . $subvalue['sub_slug'])) {
                                $isParentActive = true;
                                break;
                            }
                        }
                    @endphp
                    <div class="market-nav-group {{ $isParentActive ? 'active' : '' }}">
                        <a href="javascript:;"
                            class="market-nav-link market-nav-trigger {{ $isParentActive ? 'active' : '' }}">
                            <span>{{ $value['name'] }}</span>
                            <i class="fa-solid fa-chevron-down market-nav-caret"></i>
                        </a>
                        <ul class="market-dropdown">
                            @foreach ($value['subcategories'] as $subvalue)
                                <li>
                                    <a class="market-dropdown-item {{ request()->is('home/category/' . $subvalue['sub_slug']) ? 'active' : '' }}"
                                        href="/home/category/{{ $subvalue['sub_slug'] }}">
                                        {{ $subvalue['sub_name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endforeach
        </nav>
    </div>

    <div class="offcanvas offcanvas-start market-offcanvas" tabindex="-1" id="mobileMenuCanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">{{ setting('site_name') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div class="accordion market-mobile-accordion" id="mobileMenuAccordion">
                <div class="accordion-item">
                    <a href="/"
                        class="accordion-button market-mobile-accordion-link {{ $isHomeActive ? 'active' : 'collapsed' }}">
                        Trang chủ
                    </a>
                </div>
                @foreach ($ds_menu as $value)
                    @if (count($value['subcategories']) > 0)
                        @php
                            $isParentActive = false;
                            foreach ($value['subcategories'] as $subvalue) {
                                if (request()->is('home/category/' . $subvalue['sub_slug'])) {
                                    $isParentActive = true;
                                    break;
                                }
                            }
                        @endphp
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $loop->index }}">
                                <button class="accordion-button {{ $isParentActive ? '' : 'collapsed' }}"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $loop->index }}" aria-expanded="false"
                                    aria-controls="collapse{{ $loop->index }}">
                                    {{ $value['name'] }}
                                </button>
                            </h2>
                            <div id="collapse{{ $loop->index }}"
                                class="accordion-collapse collapse {{ $isParentActive ? 'show' : '' }}"
                                aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#mobileMenuAccordion">
                                <div class="accordion-body">
                                    @foreach ($value['subcategories'] as $subvalue)
                                        <a class="{{ request()->is('home/category/' . $subvalue['sub_slug']) ? 'active' : '' }}"
                                            href="/home/category/{{ $subvalue['sub_slug'] }}">{{ $subvalue['sub_name'] }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
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
