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
