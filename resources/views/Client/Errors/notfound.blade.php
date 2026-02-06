@extends('Client.Layout.master')
@section('title', '404 - Trang không tồn tại')
@section('content')
    <div class="text-center py-5">
        <h1 class="text-danger">404 <i class="fas fa-exclamation-triangle text-danger"></i></h1>
        <h3 class="text-danger">Trang không tồn tại</h3>
        <a href="/" class="btn btn-danger mt-3">
            Về trang chủ
        </a>
    </div>
@endsection
