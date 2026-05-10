@extends('Client.Layout.master')

@section('title', $post_detail->title)

@section('content')
    <div class="market-home">
        <div class="container market-container pt-4 pb-5">
            <section class="fade-up market-section mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 small">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-decoration-none">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/home/all-post" class="text-decoration-none">Tin đăng</a>
                        </li>
                        <li class="breadcrumb-item active market-post-detail-bc text-truncate" aria-current="page"
                            title="{{ $post_detail->title }}">
                            {{ $post_detail->title }}
                        </li>
                    </ol>
                </nav>
            </section>

            <div class="row g-3 g-lg-4">
                <div class="col-lg-7 fade-up">
                    <div class="market-section-card market-post-gallery h-100 p-0 overflow-hidden">
                        <div class="market-post-gallery__main">
                            <a href="{{ $post_detail->thumbnail }}" data-lightbox="post"
                                data-title="{{ $post_detail->title }}">
                                <img src="{{ $post_detail->thumbnail }}" alt="{{ $post_detail->title }}">
                            </a>
                        </div>
                        @if (!empty($post_images) && is_array($post_images))
                            <div class="market-post-gallery__thumbs p-3">
                                <div class="d-flex flex-wrap gap-2 justify-content-center">
                                    @foreach ($post_images as $image)
                                        <a href="{{ $image }}" data-lightbox="post"
                                            data-title="Ảnh {{ $loop->iteration }}" class="market-post-gallery__thumb">
                                            <img src="{{ $image }}" alt="Ảnh {{ $loop->iteration }}">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-5 fade-up">
                    <div class="market-section-card h-100 d-flex flex-column">
                        <span class="badge rounded-pill align-self-start mb-3 market-post-status-badge">Đang bán</span>
                        <h2 class="market-post-detail-title mb-3">{{ $post_detail->title }}</h2>
                        <p class="market-post-detail-price mb-3">
                            {{ number_format($post_detail->price, 0, ',', '.') }} <span class="fw-semibold">VNĐ</span>
                        </p>
                        @if ($post_detail->address)
                            <p class="text-muted mb-4">
                                <i class="fa-solid fa-location-dot me-1"></i>{{ $post_detail->address }}
                            </p>
                        @endif

                        <div class="market-post-meta-grid mb-4">
                            <div class="market-post-meta-item">
                                <span class="market-post-meta-label">Diện tích</span>
                                <strong>{{ $post_detail->area }} m²</strong>
                            </div>
                            <div class="market-post-meta-item">
                                <span class="market-post-meta-label">Phòng ngủ</span>
                                <strong>{{ $post_detail->bedrooms ?: '—' }}</strong>
                            </div>
                            <div class="market-post-meta-item">
                                <span class="market-post-meta-label">WC</span>
                                <strong>{{ $post_detail->bathrooms ?: '—' }}</strong>
                            </div>
                            <div class="market-post-meta-item">
                                <span class="market-post-meta-label">Dự án</span>
                                <strong class="text-truncate d-block"
                                    title="{{ $post_detail->project_name }}">{{ $post_detail->project_name ?: '—' }}</strong>
                            </div>
                        </div>

                        @if ($post_detail->phone || $post_detail->zalo_link)
                            <div class="market-post-cta mt-auto d-flex flex-column flex-sm-row gap-2">
                                @if ($post_detail->phone)
                                    <a href="tel:{{ $post_detail->phone }}"
                                        class="market-post-btn market-post-btn--primary">
                                        <i class="fa-solid fa-phone me-2"></i>Gọi ngay
                                    </a>
                                @endif
                                @if ($post_detail->zalo_link)
                                    <a href="{{ $post_detail->zalo_link }}" target="_blank" rel="noopener noreferrer"
                                        class="market-post-btn market-post-btn--outline">
                                        <i class="fa-solid fa-comments me-2"></i>Zalo
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <section class="market-section fade-up mt-2">
                <div class="market-section-card">
                    <div class="market-section-head mb-3 border-0 pb-0">
                        <div>
                            <h2 class="h4 mb-1">Thông tin chi tiết</h2>
                            <p class="mb-0 small">Mô tả đầy đủ về bất động sản.</p>
                        </div>
                    </div>
                    <div class="market-post-detail-content">
                        {!! $post_detail->content !!}
                    </div>
                </div>
            </section>

            @if ($post_detail->phone || $post_detail->zalo_link)
                <section class="market-cta-post fade-up mt-3">
                    <h3 class="h5 mb-2">Quan tâm tới tin này?</h3>
                    <p class="mb-3">Liên hệ trực tiếp để được tư vấn và xem nhà.</p>
                    <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center align-items-center flex-wrap">
                        @if ($post_detail->phone)
                            <a href="tel:{{ $post_detail->phone }}">Gọi {{ $post_detail->phone }}</a>
                        @endif
                        @if ($post_detail->zalo_link)
                            <a href="{{ $post_detail->zalo_link }}" target="_blank" rel="noopener noreferrer"
                                class="market-post-cta-zalo">Nhắn Zalo</a>
                        @endif
                    </div>
                </section>
            @endif
        </div>
    </div>
@endsection

@section('css')
    <style>
        .market-post-gallery__main {
            background: #f3f4f6;
            aspect-ratio: 4 / 3;
            overflow: hidden;
        }

        .market-post-gallery__main img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.35s ease;
        }

        .market-post-gallery__main a:hover img {
            transform: scale(1.03);
        }

        .market-post-gallery__thumb {
            display: block;
            width: 72px;
            height: 72px;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid transparent;
            transition: border-color 0.2s ease;
        }

        .market-post-gallery__thumb:hover {
            border-color: var(--mk-primary);
        }

        .market-post-gallery__thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .market-post-detail-title {
            font-size: clamp(1.15rem, 2.5vw, 1.45rem);
            line-height: 1.35;
            margin: 0;
        }

        .market-post-detail-price {
            font-size: clamp(1.35rem, 3vw, 1.75rem);
            font-weight: 700;
            color: var(--mk-primary);
            margin: 0;
        }

        .market-post-meta-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .market-post-meta-item {
            border: 1px solid var(--mk-border);
            border-radius: 12px;
            padding: 12px 14px;
            background: #fafafa;
        }

        .market-post-meta-label {
            display: block;
            font-size: 12px;
            color: var(--mk-muted);
            margin-bottom: 4px;
        }

        .market-post-meta-item strong {
            font-size: 15px;
            font-weight: 600;
        }

        .market-post-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 18px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: opacity 0.2s ease, transform 0.2s ease;
            flex: 1;
            text-align: center;
        }

        .market-post-btn:hover {
            opacity: 0.92;
        }

        .market-post-btn--primary {
            background: var(--mk-primary);
            color: #fff;
        }

        .market-post-btn--outline {
            background: #fff;
            color: var(--mk-text);
            border: 1px solid var(--mk-border);
        }

        .market-post-detail-content {
            font-size: 15px;
            line-height: 1.7;
            color: var(--mk-text);
        }

        .market-post-detail-content p:last-child {
            margin-bottom: 0;
        }

        .market-post-detail-content img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
        }

        .market-post-detail-bc {
            max-width: 12rem;
        }

        .market-post-status-badge {
            background: var(--mk-primary) !important;
            font-size: 11px;
            padding: 6px 12px;
            color: #fff;
        }

        .market-cta-post a.market-post-cta-zalo {
            background: #0f67ff;
        }

        .market-cta-post a.market-post-cta-zalo:hover {
            opacity: 0.92;
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
