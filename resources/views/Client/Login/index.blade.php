@extends('Client.Layout.master')

@section('title', 'Đăng nhập')

@section('css')
    <link href="/assets_client/css/client-auth.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container market-container">
        <div class="client-auth-page">
            <div class="card client-auth-card">
                <div class="card-body">
                    <div class="client-auth-logo">
                        <img src="/assets_client/images/logo.jpg" alt="Logo">
                    </div>
                    <h1 class="client-auth-title">Đăng nhập</h1>
                    <p class="client-auth-subtitle">Nhập email/số điện thoại và mật khẩu để tiếp tục.</p>

                    <form class="row g-3 client-auth-form" method="POST" action="/user/login">
                        @csrf
                        <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Email / Số điện thoại</label>
                            <input class="form-control" id="inputEmailAddress" name="login"
                                placeholder="vd: email@gmail.com hoặc 0909090909" required>
                        </div>
                        <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">Mật khẩu</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control border-end-0" id="inputChoosePassword"
                                    name="password" placeholder="Nhập mật khẩu" required>
                                <a href="javascript:;" class="input-group-text bg-transparent" tabindex="-1"><i
                                        class="bx bx-hide"></i></a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="remember" id="rememberLogin"
                                    value="1">
                                <label class="form-check-label" for="rememberLogin">Ghi nhớ đăng nhập</label>
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            <a class="text-muted text-decoration-none" href="#">Quên mật khẩu?</a>
                        </div>
                        <div class="col-12 pt-1">
                            <button type="submit" class="btn btn-client-primary w-100">
                                <i class="bx bxs-lock-open me-1"></i>Đăng nhập
                            </button>
                            <button type="button" class="btn btn-outline-secondary w-100 mt-2"
                                onclick="window.location.href='{{ url('/') }}'">Quay lại trang chủ</button>
                        </div>
                        <div class="col-12 text-center pt-2">
                            <span class="text-muted">Chưa có tài khoản?</span>
                            <a class="client-auth-link ms-1" href="{{ url('/user/register') }}">Đăng ký</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                const input = $('#show_hide_password input');
                const icon = $('#show_hide_password i');
                if (input.attr("type") === "text") {
                    input.attr('type', 'password');
                    icon.addClass("bx-hide").removeClass("bx-show");
                } else {
                    input.attr('type', 'text');
                    icon.removeClass("bx-hide").addClass("bx-show");
                }
            });
        });
    </script>
@endsection
