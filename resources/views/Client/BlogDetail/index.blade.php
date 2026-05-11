@extends('Client.Layout.master')

@section('title', $blog_detail->title)

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
                            <a href="/home/blog" class="text-decoration-none">
                                Tin tức
                            </a>
                        </li>

                        <li class="breadcrumb-item active market-blog-breadcrumb text-truncate" aria-current="page"
                            title="{{ $blog_detail->title }}">
                            {{ $blog_detail->title }}
                        </li>
                    </ol>
                </nav>
            </section>

            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <section class="market-section fade-up">
                        <div class="market-section-card market-blog-detail-card">

                            <div class="market-blog-detail-head">
                                <span class="market-blog-detail-badge">
                                    Tin tức bất động sản
                                </span>

                                <h1 class="market-blog-detail-title">
                                    {{ $blog_detail->title }}
                                </h1>

                                <div class="market-blog-detail-meta">
                                    <span>
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        Ngày đăng:
                                        {{ $blog_detail->created_at->format('d/m/Y') }}
                                    </span>
                                </div>
                            </div>

                            <div class="market-blog-detail-content">
                                {!! $blog_detail->content !!}
                            </div>

                        </div>
                    </section>
                </div>

                <aside class="col-lg-4 fade-up">
                    <div class="market-blog-sidebar">
                        <h2 class="market-blog-sidebar-title">Bài viết khác</h2>

                        @if (isset($blog_related) && $blog_related->count() > 0)
                            <div class="market-news-card-stack market-news-card-stack--compact">
                                @foreach ($blog_related as $hot)
                                    @php
                                        $hotHref = '/home/blog/' . $hot->slug . '/' . $hot->id;
                                        $hotExcerpt = \Illuminate\Support\Str::limit(
                                            \Illuminate\Support\Str::squish(strip_tags($hot->content)),
                                            120,
                                            '…',
                                        );
                                    @endphp
                                    <article class="market-news-card market-news-card--thumb-left market-news-card--compact">
                                        <div class="market-news-card-thumb">
                                            <a href="{{ $hotHref }}" title="{{ $hot->title }}"
                                                class="market-news-card-thumb-link thumb-5x3">
                                                <img src="{{ $hot->thumbnail }}" alt="{{ $hot->title }}" loading="lazy"
                                                    width="400" height="240">
                                            </a>
                                        </div>
                                        <div class="market-news-card-body">
                                            <h3 class="market-news-card-title">
                                                <a href="{{ $hotHref }}" title="{{ $hot->title }}">{{ $hot->title }}</a>
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
                        @else
                            <p class="text-muted mb-0 small">Chưa có bài viết khác.</p>
                        @endif
                    </div>
                </aside>
            </div>

        </div>
    </div>
@endsection

@section('css')
    <style>
        .market-blog-detail-card {
            padding: clamp(1.1rem, 2vw, 2rem);
        }

        .market-blog-detail-head {
            border-bottom: 1px solid var(--mk-border);
            padding-bottom: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .market-blog-detail-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(15, 103, 255, 0.08);
            color: var(--mk-primary);
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .market-blog-detail-title {
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            line-height: 1.4;
            font-weight: 700;
            color: var(--mk-text);
            margin-bottom: 1rem;
        }

        .market-blog-detail-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            color: var(--mk-muted);
            font-size: 14px;
        }

        .market-blog-detail-content {
            font-size: 15px;
            line-height: 1.8;
            color: var(--mk-text);
        }

        .market-blog-detail-content img {
            max-width: 100%;
            height: auto;
            border-radius: 16px;
            margin: 1rem 0;
        }

        .market-blog-detail-content iframe {
            width: 100%;
            border-radius: 16px;
            margin: 1rem 0;
        }

        .market-blog-detail-content h1,
        .market-blog-detail-content h2,
        .market-blog-detail-content h3,
        .market-blog-detail-content h4,
        .market-blog-detail-content h5,
        .market-blog-detail-content h6 {
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
            line-height: 1.5;
        }

        .market-blog-detail-content p:last-child {
            margin-bottom: 0;
        }

        .market-blog-detail-content ul,
        .market-blog-detail-content ol {
            padding-left: 1.2rem;
        }

        .market-blog-detail-content table {
            width: 100%;
            margin: 1rem 0;
            border-collapse: collapse;
        }

        .market-blog-detail-content table th,
        .market-blog-detail-content table td {
            border: 1px solid var(--mk-border);
            padding: 10px 12px;
        }

        .market-blog-detail-content blockquote {
            border-left: 4px solid var(--mk-primary);
            background: #f8fafc;
            padding: 1rem 1.2rem;
            border-radius: 12px;
            color: var(--mk-muted);
            margin: 1.5rem 0;
        }

        .market-blog-breadcrumb {
            max-width: 14rem;
        }

        /* Sidebar + cards (giống trang list tin) */
        .market-blog-sidebar {
            border: 1px solid var(--mk-border);
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
            color: var(--mk-text);
        }

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
            border: 1px solid var(--mk-border);
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

        .market-news-card-thumb {
            flex: 0 0 clamp(72px, 26%, 108px);
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
        }

        .market-news-card-body {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .market-news-card-title {
            font-size: 0.9rem;
            font-weight: 700;
            line-height: 1.35;
            margin: 0 0 6px;
        }

        .market-news-card-title a {
            color: var(--mk-text);
            text-decoration: none;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .market-news-card-description {
            margin: 0 0 6px;
            font-size: 12px;
            line-height: 1.5;
        }

        .market-news-card-description a {
            color: var(--mk-muted);
            text-decoration: none;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            word-break: break-word;
        }

        .market-news-card-meta-line {
            margin: 0;
            font-size: 11px;
            color: #94a3b8;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 6px;
        }

        .market-news-card-meta-dot {
            opacity: 0.75;
        }

        @media (max-width: 991.98px) {
            .market-blog-sidebar {
                position: static;
            }
        }

        .blog-content {
            line-height: 1.8;
            font-size: 15px;
            color: #374151;
            word-break: break-word;
            overflow-wrap: break-word;
        }

        .blog-content img {
            max-width: 100%;
            height: auto;
            display: block;
            border-radius: 12px;
            margin: 16px auto;
        }

        .blog-content iframe {
            max-width: 100%;
            width: 100%;
            border: 0;
        }

        .blog-content table {
            width: 100% !important;
            display: block;
            overflow-x: auto;
            border-collapse: collapse;
        }

        .blog-content table td,
        .blog-content table th {
            border: 1px solid #ddd;
            padding: 10px;
        }

        .blog-content pre {
            overflow-x: auto;
            background: #111827;
            color: white;
            padding: 16px;
            border-radius: 12px;
        }

        .blog-content * {
            max-width: 100%;
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
