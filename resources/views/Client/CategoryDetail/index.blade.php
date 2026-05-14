@extends('Client.Layout.master')

@section('title', 'Danh mục ' . $category->name)

@section('content')
    <div class="market-home">
        <div class="container market-container pt-4 pb-5">

            <section class="fade-up market-section mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 small">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-decoration-none">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item active market-blog-breadcrumb text-truncate" aria-current="page"
                            title="{{ $category->name }}">
                            {{ $category->name }}
                        </li>
                    </ol>
                </nav>
            </section>

            <header class="market-blog-page-header market-category-page-header fade-up market-section mb-4">
                <div class="d-flex flex-column flex-md-row align-items-start justify-content-between gap-3">
                    <div>
                        <h1 class="market-blog-page-heading mb-2">{{ $category->name }}</h1>
                        <p class="market-blog-page-lead text-muted mb-0">
                            @if ($list_posts->count() > 0)
                                {{ $list_posts->count() }} tin đăng bất động sản trong danh mục.
                            @else
                                Không có tin đăng trong danh mục này.
                            @endif
                        </p>
                    </div>
                    <a href="/home/all-post" class="market-category-view-all-link mt-1 mt-md-0">Xem tất cả tin</a>
                </div>
            </header>

            @if ($list_posts->count() > 0)
                <section class="market-section market-featured fade-up">
                    <div class="row g-3">
                        @foreach ($list_posts as $value)
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
                        <p class="text-muted mb-3 mb-md-4">Chưa có tin đăng trong danh mục này.</p>
                        <a href="/" class="market-category-back-home d-inline-block">Về trang chủ</a>
                    </div>
                </section>
            @endif

        </div>
    </div>
@endsection

@section('css')
    <style>
        .market-category-back-home {
            color: var(--mk-primary);
            text-decoration: none;
            font-weight: 600;
        }

        .market-category-back-home:hover {
            opacity: 0.88;
        }

        .market-blog-breadcrumb {
            max-width: 14rem;
        }

        .market-blog-page-heading {
            font-size: clamp(1.5rem, 2.5vw, 2rem);
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.02em;
        }

        .market-blog-page-lead {
            max-width: 680px;
            font-size: 15px;
            line-height: 1.65;
        }

        .market-category-page-header {
            border: 1px solid var(--mk-border);
            border-radius: 12px;
            background: #fff;
            padding: clamp(1rem, 2vw, 1.4rem);
        }

        .market-category-view-all-link {
            text-decoration: none;
            font-weight: 600;
            color: var(--mk-primary);
            white-space: nowrap;
        }

        .market-category-view-all-link:hover {
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
