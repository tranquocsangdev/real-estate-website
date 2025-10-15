@extends('Client.Layout.master')

@section('content')
    <div class="container py-5">

        {{-- 🏠 Tiêu đề --}}
        <h2 class="mt-4 mb-4 text-center text-md-start text-dark">
            Tin đăng thuộc danh mục: <span class="text-primary">{{ $category->name }}</span>
        </h2>

        {{-- 🧱 Danh sách bài đăng --}}
        <div class="row g-4">
            @forelse ($list_posts as $post)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card shadow border-0 h-100 rounded-3">
                        <div class="position-relative">
                            <img src="{{ $post->thumbnail ?? '/assets_client/images/no-image.jpg' }}"
                                class="card-img-top rounded-top-3" alt="{{ $post->title }}">
                            <span
                                class="badge {{ $post->status == 'sold' ? 'bg-secondary' : 'bg-success' }} position-absolute top-0 end-0 m-3 p-2">
                                {{ $post->status == 'sold' ? 'Đã bán' : 'Còn bán' }}
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-primary">{{ $post->title }}</h5>
                            <p class="card-text text-muted small mb-2">
                                <i class="bi bi-geo-alt-fill me-1"></i>
                                {{ $post->address ?? 'Đang cập nhật' }}
                            </p>
                            <ul class="list-unstyled mb-3 small">
                                <li class="mb-1">
                                    <i class="bi bi-aspect-ratio-fill me-2 text-secondary"></i>
                                    <strong>Diện tích:</strong>
                                    <span class="fw-bold">{{ $post->area ?? '—' }} m²</span>
                                </li>
                                <li>
                                    <i class="bi bi-cash-stack me-2 text-secondary"></i>
                                    <strong>Giá:</strong>
                                    <span class="fw-bold text-danger">{{ number_format($post->price, 0, ',', '.') }}
                                        VNĐ</span>
                                </li>
                            </ul>

                            <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top">
                                <a :href="post.map_link" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-map-fill"></i>Xem Vị Trí
                                </a>
                                <div>
                                    <a href="#" class="btn btn-primary btn-sm me-2">Chi tiết</a>
                                    <a href="tel:{{ $post->phone }}" class="btn btn-success btn-sm">
                                        <i class="bi bi-telephone-fill"></i> Gọi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted">
                    <h5>Không có bài đăng nào trong danh mục này.</h5>
                </div>
            @endforelse
        </div>
    </div>
@endsection
