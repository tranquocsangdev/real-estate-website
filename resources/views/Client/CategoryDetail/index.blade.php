@extends('Client.Layout.master')
@section('title', 'Danh mục ' . $category->name)
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h5 class="text-dark">
                Danh mục : <span class="text-primary">{{ $category->name }}</span>
            </h5>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @forelse ($list_posts as $key => $value)
                            <div class="col-lg-3 mb-2">
                                <div class="card border-end property-card-bs h-100 d-flex flex-column">
                                    <div class="position-relative text-center">
                                        <img src="{{ $value->thumbnail }}" class="card-img-top object-fit-cover p-1"
                                            style="width: 100%; height: 200px;" alt="Bất động sản">

                                        <div
                                            style="
                                            position:absolute;
                                            top:0;
                                            left:0;
                                            padding:6px 14px;
                                            font-size:12px;
                                            font-weight:700;
                                            color:#fff;
                                            background:#dc3545;
                                            border-bottom-right-radius:12px;
                                        ">
                                            BÁN
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title mb-1" title="{{ $value->title }}"
                                            style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
                                            {{ $value->title }}
                                        </h5>


                                        <p class="text-muted small mb-2">
                                            <b> <i class="fas fa-map-marker-alt me-1"></i> Địa điểm:</b>
                                            {{ $value->address }}
                                        </p>

                                        <div class="d-flex gap-3 small text-muted mb-3">
                                            <span><b><i class="fas fa-money-bill me-1"></i> Giá bán:</b>
                                                <span
                                                    class="text-danger fw-bold">{{ number_format($value->price, 0, ',', '.') }}
                                                    VNĐ</span></span>
                                        </div>
                                        <div class="cta-actions">
                                            <a href="/post/{{ $value->slug }}/{{ $value->id }}"
                                                class="btn btn-cta-pro btn-cta-pro--sky w-60"> Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5 text-muted">
                                <span>Không có tin đăng nào trong danh mục này.</span>
                                <div class="mt-3">
                                    <i class="bx bx-search-alt-2 fs-1"></i>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
