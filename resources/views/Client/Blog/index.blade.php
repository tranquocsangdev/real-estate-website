@extends('Client.Layout.master')

@section('title', 'Tin tức bất động sản ')

@section('content')
    <div class="market-home">
        <div class="container market-container pt-4 pb-5">
            <section class="fade-up market-section mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 small">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-decoration-none">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Tin tức
                        </li>
                    </ol>
                </nav>
            </section>

            @if ($ds_blog->count() > 0)
                @php
                    $featuredMain = $ds_blog->first();
                    $listBlogs = $ds_blog->slice(1);
                    $hasSidebar = $blog_most_viewed->count() > 0;
                @endphp

                <header class="market-blog-page-header text-center fade-up market-section mb-4 px-2">
                    <h1 class="market-blog-page-heading mb-3">Tin tức bất động sản mới nhất</h1>
                    <p class="market-blog-page-lead text-muted mx-auto mb-0">
                        Cập nhật nhanh các tin tức thị trường, xu hướng đầu tư và phân tích bất động sản trong nước —
                        giúp bạn nắm bắt cơ hội kịp thời.
                    </p>
                </header>

                <div class="row g-4 align-items-start">
                    <div class="{{ $hasSidebar ? 'col-lg-8' : 'col-lg-12' }}">
                        <section class="market-section market-blog-featured fade-up mb-4 mb-lg-5">
                            <div class="row g-3 align-items-stretch">
                                <div class="col-12">
                                    <a href="/home/blog/{{ $featuredMain->slug }}/{{ $featuredMain->id }}"
                                        class="market-blog-hero-link d-block text-decoration-none text-reset h-100">
                                        <article class="market-blog-hero h-100">
                                            <img src="{{ $featuredMain->thumbnail }}" alt="{{ $featuredMain->title }}">
                                            <span class="market-blog-img-tag">TIN TỨC</span>
                                            <div class="market-blog-hero-caption">
                                                <h2 class="market-blog-hero-title">{{ $featuredMain->title }}</h2>
                                            </div>
                                        </article>
                                    </a>
                                </div>
                            </div>
                        </section>

                        @if ($listBlogs->count() > 0)
                            <section class="market-section market-blog-list-section fade-up market-news-card-stack">
                                @foreach ($listBlogs as $value)
                                    @php
                                        $blogHref = '/home/blog/' . $value->slug . '/' . $value->id;
                                        $excerpt = \Illuminate\Support\Str::limit(
                                            \Illuminate\Support\Str::squish(strip_tags($value->content)),
                                            180,
                                            '…',
                                        );
                                    @endphp
                                    <article class="market-news-card market-news-card--thumb-left"
                                        data-publishtime="{{ $value->created_at->timestamp }}">
                                        <div class="market-news-card-thumb">
                                            <a href="{{ $blogHref }}" title="{{ $value->title }}"
                                                class="market-news-card-thumb-link thumb-5x3">
                                                <img src="{{ $value->thumbnail }}" alt="{{ $value->title }}" loading="lazy"
                                                    width="500" height="300">
                                            </a>
                                        </div>
                                        <div class="market-news-card-body">
                                            <h3 class="market-news-card-title">
                                                <a href="{{ $blogHref }}"
                                                    title="{{ $value->title }}">{{ $value->title }}</a>
                                            </h3>
                                            <p class="market-news-card-description">
                                                <a href="{{ $blogHref }}"
                                                    title="{{ $value->title }}">{{ $excerpt }}</a>
                                            </p>
                                            <p class="market-news-card-meta-line">
                                                <span
                                                    class="market-news-card-meta-date">{{ $value->created_at->format('d/m/Y H:i') }}</span>
                                                <span class="market-news-card-meta-dot" aria-hidden="true">·</span>
                                                <span class="market-news-card-meta-author">Ban biên tập</span>
                                            </p>
                                        </div>
                                    </article>
                                @endforeach
                            </section>
                        @endif
                    </div>

                    @if ($hasSidebar)
                        <aside class="col-lg-4 fade-up">
                            <div class="market-blog-sidebar">
                                <h2 class="market-blog-sidebar-title">Được xem nhiều</h2>
                                <div class="market-news-card-stack market-news-card-stack--compact">
                                    @foreach ($blog_most_viewed as $hot)
                                        @php
                                            $hotHref = '/home/blog/' . $hot->slug . '/' . $hot->id;
                                            $hotExcerpt = \Illuminate\Support\Str::limit(
                                                \Illuminate\Support\Str::squish(strip_tags($hot->content)),
                                                120,
                                                '…',
                                            );
                                        @endphp
                                        <article
                                            class="market-news-card market-news-card--thumb-left market-news-card--compact"
                                            data-publishtime="{{ $hot->created_at->timestamp }}">
                                            <div class="market-news-card-thumb">
                                                <a href="{{ $hotHref }}" title="{{ $hot->title }}"
                                                    class="market-news-card-thumb-link thumb-5x3">
                                                    <img src="{{ $hot->thumbnail }}" alt="{{ $hot->title }}"
                                                        loading="lazy" width="400" height="240">
                                                </a>
                                            </div>
                                            <div class="market-news-card-body">
                                                <h3 class="market-news-card-title">
                                                    <a href="{{ $hotHref }}"
                                                        title="{{ $hot->title }}">{{ $hot->title }}</a>
                                                </h3>
                                                <p class="market-news-card-description">
                                                    <a href="{{ $hotHref }}"
                                                        title="{{ $hot->title }}">{{ $hotExcerpt }}</a>
                                                </p>
                                                <p class="market-news-card-meta-line">
                                                    <span
                                                        class="market-news-card-meta-date">{{ $hot->created_at->format('d/m/Y') }}</span>
                                                    <span class="market-news-card-meta-dot" aria-hidden="true">·</span>
                                                    <span
                                                        class="market-news-card-meta-author">{{ number_format($hot->views ?? 0) }}
                                                        lượt xem</span>
                                                </p>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            </div>
                        </aside>
                    @endif
                </div>
            @else
                <section class="market-section fade-up">
                    <div class="market-section-card text-center py-5 px-3">
                        <i class="fa-solid fa-folder-open fs-1 text-muted mb-3 d-block opacity-50"></i>
                        <p class="text-muted mb-3 mb-md-4">Hiện tại chưa có tin tức nào .</p>
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

        .market-blog-page-heading {
            font-size: clamp(1.5rem, 2.5vw, 2rem);
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.02em;
        }

        .market-blog-page-lead {
            max-width: 640px;
            font-size: 15px;
            line-height: 1.65;
        }

        /* Featured hero */
        .market-blog-hero {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            min-height: 280px;
            background: #e2e8f0;
        }

        .market-blog-hero img {
            width: 100%;
            height: 100%;
            min-height: 280px;
            object-fit: cover;
            display: block;
            transition: transform 0.35s ease;
        }

        .market-blog-hero-link:hover .market-blog-hero img {
            transform: scale(1.04);
        }

        .market-blog-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.82) 0%, rgba(15, 23, 42, 0.2) 45%, transparent 70%);
            pointer-events: none;
        }

        .market-blog-img-tag {
            position: absolute;
            left: 12px;
            top: 12px;
            z-index: 2;
            background: #374151;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.04em;
            padding: 5px 10px;
            border-radius: 2px;
        }

        .market-blog-hero-caption {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 2;
            padding: 20px 18px 18px;
        }

        .market-blog-hero-title {
            color: #fff;
            font-size: clamp(1.05rem, 2vw, 1.35rem);
            font-weight: 700;
            line-height: 1.35;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .market-blog-featured-side {
            gap: 0;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #fff;
            overflow: hidden;
        }

        .market-blog-featured-side-item {
            padding: 14px 16px;
            border-bottom: 1px solid #e5e7eb;
            transition: background 0.2s ease;
        }

        .market-blog-featured-side-item:last-child {
            border-bottom: none;
        }

        .market-blog-featured-side-item:hover {
            background: #f8fafc;
        }

        .market-blog-featured-side-meta {
            display: block;
            font-size: 12px;
            color: #64748b;
            margin-bottom: 6px;
        }

        .market-blog-featured-side-title {
            font-size: 15px;
            font-weight: 700;
            line-height: 1.4;
            margin: 0;
            color: #0f172a;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Tin dạng card (thumb trái, giống layout stream tin) */
        .market-news-card-stack {
            display: flex;
            flex-direction: column;
            gap: 16px;
            width: 100%;
        }

        .market-news-card-stack--compact {
            gap: 12px;
        }

        .market-news-card {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 18px;
            margin: 0;
            padding: 16px 18px;
            width: 100%;
            box-sizing: border-box;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .market-news-card--compact {
            gap: 12px;
            padding: 12px 12px;
            border-radius: 10px;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.05);
        }

        .market-news-card--compact:hover {
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.07);
        }

        .market-news-card--compact .market-news-card-thumb {
            flex: 0 0 clamp(72px, 26%, 108px);
        }

        .market-news-card--compact .market-news-card-title {
            font-size: 0.9rem;
            margin: 0 0 6px;
        }

        .market-news-card--compact .market-news-card-description {
            margin: 0 0 6px;
            font-size: 12px;
            line-height: 1.5;
        }

        .market-news-card--compact .market-news-card-meta-line {
            font-size: 11px;
        }

        .market-news-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        }

        .market-news-card-thumb {
            flex: 0 0 clamp(132px, 30vw, 220px);
            align-self: flex-start;
        }

        .market-news-card-thumb-link {
            display: block;
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            background: #e2e8f0;
        }

        .market-news-card-thumb-link.thumb-5x3 {
            aspect-ratio: 5 / 3;
        }

        .market-news-card-thumb-link img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.35s ease;
        }

        .market-news-card:hover .market-news-card-thumb-link img {
            transform: scale(1.04);
        }

        .market-news-card-body {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .market-news-card-title {
            font-size: 1.05rem;
            font-weight: 700;
            line-height: 1.35;
            margin: 0 0 8px;
        }

        .market-news-card-title a {
            color: #0f172a;
            text-decoration: none;
            transition: color 0.2s ease;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .market-news-card:hover .market-news-card-title a,
        .market-news-card-title a:hover {
            color: var(--mk-primary, #2563eb);
        }

        .market-news-card-description {
            margin: 0 0 10px;
            font-size: 14px;
            line-height: 1.55;
        }

        .market-news-card-description a {
            color: #64748b;
            text-decoration: none;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            word-break: break-word;
            transition: color 0.2s ease;
        }

        .market-news-card:hover .market-news-card-description a,
        .market-news-card-description a:hover {
            color: #475569;
        }

        .market-news-card-meta-line {
            margin: 0;
            font-size: 12px;
            color: #94a3b8;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 6px;
        }

        .market-news-card-meta-dot {
            opacity: 0.75;
        }

        /* Sidebar */
        .market-blog-sidebar {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px 18px;
            background: #fff;
            position: sticky;
            top: 100px;
        }

        .market-blog-sidebar-title {
            font-size: 17px;
            font-weight: 800;
            margin: 0 0 14px;
            color: #0f172a;
        }

        @media (max-width: 767.98px) {
            .market-news-card.market-news-card--thumb-left {
                flex-direction: column;
                gap: 14px;
            }

            .market-news-card-thumb {
                flex: none;
                width: 100%;
            }

            .market-news-card--compact .market-news-card-thumb {
                flex: none;
                width: 100%;
            }

            .market-news-card-thumb-link.thumb-5x3 {
                aspect-ratio: 16 / 9;
            }

            .market-blog-sidebar {
                position: static;
            }
        }

        @media (min-width: 992px) {
            .market-news-card--compact.market-news-card--thumb-left {
                flex-direction: row;
            }
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
