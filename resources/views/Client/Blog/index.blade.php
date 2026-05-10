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
                <section class="market-section market-featured fade-up">
                    <div class="row g-3">
                        @foreach ($ds_blog as $value)
                            <div class="col-lg-3 col-md-6">
                                <a href="/home/blog/{{ $value->slug }}/{{ $value->id }}"
                                    class="d-block h-100 text-decoration-none text-reset">
                                    <div class="market-property-card h-100">
                                        <div class="market-property-thumb">
                                            <span class="badge">Bán</span>
                                            <img src="{{ $value->thumbnail }}" alt="{{ $value->title }}">
                                        </div>
                                        <div class="market-property-body">
                                            <h3 title="{{ $value->title }}">{{ $value->title }}</h3>
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
