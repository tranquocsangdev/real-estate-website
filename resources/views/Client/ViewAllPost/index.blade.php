@extends('Client.Layout.master')

@section('title', 'Tất cả tin đăng')

@section('content')
    <div class="market-home">
        <div class="container market-container pt-4 pb-5">

            <section class="fade-up market-section mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 small">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-decoration-none">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tất cả tin đăng</li>
                    </ol>
                </nav>
                <div class="market-section-head align-items-start flex-column flex-md-row">
                    <div>
                        <h2 class="mb-2">Tất cả tin đăng</h2>
                        <p class="mb-0">
                            @if ($ds_post->count() > 0)
                                {{ $ds_post->count() }} tin bất động sản đang được hiển thị.
                            @else
                                @if (!empty($hasFilters))
                                    Không có tin đăng phù hợp bộ lọc tìm kiếm.
                                @else
                                    Hiện chưa có tin đăng nào.
                                @endif
                            @endif
                        </p>
                    </div>
                    <a href="/" class="mt-3 mt-md-0 align-self-start">Về trang chủ</a>
                </div>
            </section>

            @if ($ds_post->count() > 0)
                <section class="market-section market-featured fade-up">
                    <div class="row g-3">
                        @foreach ($ds_post as $value)
                            <div class="col-6 col-lg-3">
                                <a href="/home/post/{{ $value->slug }}/{{ $value->id }}"
                                    class="d-block h-100 text-decoration-none text-reset">
                                    <div class="market-property-card h-100">
                                        <div class="market-property-thumb">
                                            <span class="badge">Bán</span>
                                            <img src="{{ $value->thumbnail }}" alt="{{ $value->title }}">
                                        </div>
                                        <div class="market-property-body">
                                            <h3 title="{{ $value->title }}">{{ $value->title }}</h3>
                                            <p class="address mb-0"><i class="fa-solid fa-location-dot me-1"></i>{{ $value->address }}</p>
                                            <p class="price mb-0">{{ number_format($value->price, 0, ',', '.') }} VNĐ</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>
            @else
                <section class="market-section fade-up">
                    <div class="market-section-card text-center py-5 px-3">
                        <i class="fa-solid fa-folder-open fs-1 text-muted mb-3 d-block opacity-50"></i>
                        <p class="text-muted mb-3 mb-md-4">
                            @if (!empty($hasFilters))
                                Không có tin đăng phù hợp bộ lọc tìm kiếm.
                            @else
                                Chưa có tin đăng bất động sản.
                            @endif
                        </p>
                        <a href="/" class="market-viewall-back-home d-inline-block">Về trang chủ</a>
                    </div>
                </section>
            @endif

        </div>
    </div>
@endsection

@section('css')
    <style>
        .market-viewall-back-home {
            color: var(--mk-primary);
            text-decoration: none;
            font-weight: 600;
        }

        .market-viewall-back-home:hover {
            opacity: 0.88;
        }
    </style>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-up');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('show');
                    }
                });
            }, {
                threshold: 0.12
            });
            fadeElements.forEach(el => observer.observe(el));
        });
    </script>
@endsection
