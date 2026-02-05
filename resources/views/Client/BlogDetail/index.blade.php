@extends('Client.Layout.master')
@section('title', $blog_detail->title)
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h5>{{ $blog_detail->title }}</h5>
            <p class="text-muted small mb-2">
                <b> <i class="fas fa-calendar-alt me-1"></i> Ngày đăng:</b>
                {{ $blog_detail->created_at->format('d/m/Y') }}
            </p>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <p class="card-text small">{!! $blog_detail->content !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
