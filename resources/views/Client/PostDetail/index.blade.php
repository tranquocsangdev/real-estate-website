@extends('Client.Layout.master')
@section('title','' . $post_detail->title)
@section('content')
    <div class="card">
        <div class="row g-0">
            <div class="col-md-4 border-end">
                <a href="{{ $post_detail->thumbnail }}" data-lightbox="post" data-title="{{ $post_detail->title }}">
                    <img src="{{ $post_detail->thumbnail }}" class="img-fluid p-3" alt="...">
                </a>
                <hr class="m-1">
                @if ($post_images)
                    <div class="row mb-3 row-cols-auto g-2 justify-content-center p-3">
                        @foreach ($post_images as $image)
                            <div class="col"><a href="{{ $image }}" data-lightbox="post" data-title="Ảnh {{ $loop->iteration }}">
                                <img src="{{ $image }}" width="70" class="border rounded">
                            </a></div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">{{ $post_detail->title }}</h4>
                    <div class="mb-3">
                        <span class="price h4 text-danger">Giá bán: <b>{{ number_format($post_detail->price, 0, ',', '.') }}
                                VNĐ</b></span> <br>
                        <div class="row mt-3">
                            <div class="col">
                                <span class="text-muted"><b>Diện tích:</b> {{ $post_detail->area }} m²</span>
                            </div>
                            <div class="col">
                                <span class="text-muted"><b>Phòng ngủ:</b>
                                    {{ $post_detail->bedrooms ? $post_detail->bedrooms : 'Không có' }}</span>
                            </div>
                            <div class="col">
                                <span class="text-muted"><b>Phòng vệ sinh:</b>
                                    {{ $post_detail->bathrooms ? $post_detail->bathrooms : 'Không có' }}</span>
                            </div>
                            <div class="col">
                                <span class="text-muted"><b>Dự án:</b>
                                    {{ $post_detail->project_name ? $post_detail->project_name : 'Không có' }}</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="card-title">Thông tin chi tiết</h5>
                    <p class="card-text fs-6">{!! $post_detail->content !!}</p>
                    <hr>
                    <div class="text-center cta-actions">
                        <a href="tel:{{ $post_detail->phone }}" class="btn btn-cta-pro btn-cta-pro--emerald">Liên hệ
                            ngay</a>
                        <a href="{{ $post_detail->zalo_link }}" class="btn btn-cta-pro btn-cta-pro--sky">Nhắn tin Zalo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
