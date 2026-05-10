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
                        <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                    </ol>
                </nav>
                <div class="market-section-head align-items-start flex-column flex-md-row">
                    <div>
                        <h2 class="mb-2">{{ $category->name }}</h2>
                        <p class="mb-0">
                            @if ($list_posts->count() > 0)
                                {{ $list_posts->count() }} tin đăng bất động sản trong danh mục.
                            @elseif ($list_blogs->count() > 0)
                                {{ $list_blogs->count() }} bài viết trong danh mục.
                            @else
                                Không có nội dung trong danh mục này.
                            @endif
                        </p>
                    </div>
                    <a href="/home/all-post" class="mt-3 mt-md-0 align-self-start">Xem tất cả tin</a>
                </div>
            </section>

            @if ($list_posts->count() > 0)
                <section class="market-section market-featured fade-up">
                    <div class="row g-3">
                        @foreach ($list_posts as $value)
                            <div class="col-lg-3 col-md-6">
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
            @elseif ($list_blogs->count() > 0)
                <section class="market-section fade-up">
                    <div class="market-section-head mb-3">
                        <div>
                            <h2 class="h4 mb-1">Bài viết</h2>
                            <p class="mb-0">Tin tức và kiến thức liên quan danh mục.</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        @foreach ($list_blogs as $value)
                            <div class="col-12">
                                <a href="/home/blog/{{ $value->slug }}/{{ $value->id }}"
                                    class="market-blog-row text-decoration-none text-reset d-block">
                                    <div class="market-article-card market-blog-row__inner d-flex flex-column flex-md-row gap-0 p-0 overflow-hidden">
                                        <div class="market-blog-row__thumb flex-shrink-0">
                                            <img src="{{ $value->thumbnail }}" alt="{{ $value->title }}"
                                                class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-3 p-md-4 flex-grow-1 d-flex flex-column justify-content-center">
                                            <h3 class="h5 mb-2">{{ $value->title }}</h3>
                                            <p class="small text-muted mb-0">
                                                {{ Str::limit(strip_tags($value->content), 160) }}
                                            </p>
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
                        <p class="text-muted mb-3 mb-md-4">Chưa có tin đăng hoặc bài viết trong danh mục này.</p>
                        <a href="/" class="market-category-back-home d-inline-block">Về trang chủ</a>
                    </div>
                </section>
            @endif

        </div>
    </div>
@endsection

@section('css')
    <style>
        .market-blog-row__thumb {
            width: 100%;
            min-height: 180px;
            max-height: 220px;
            overflow: hidden;
            background: #f3f4f6;
        }

        @media (min-width: 768px) {
            .market-blog-row__thumb {
                width: 280px;
                max-width: 280px;
                min-height: 200px;
                max-height: none;
            }
        }

        .market-blog-row:hover .market-article-card {
            box-shadow: 0 18px 30px rgba(15, 23, 42, 0.12);
            border-color: #e5e7eb;
        }

        .market-blog-row .market-article-card {
            transition: box-shadow 0.25s ease, border-color 0.25s ease;
        }

        .market-category-back-home {
            color: var(--mk-primary);
            text-decoration: none;
            font-weight: 600;
        }

        .market-category-back-home:hover {
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
