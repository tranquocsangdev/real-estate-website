@extends('Client.Layout.master')

@section('title', 'Đăng ký')

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
                    <h1 class="client-auth-title">Đăng ký</h1>
                    <p class="client-auth-subtitle">Điền thông tin để tạo tài khoản mới.</p>

                    <form class="row g-3 client-auth-form" method="POST" action="{{ url('/user/register') }}">
                        @csrf
                        <div class="col-12">
                            <label for="inputName" class="form-label">Họ tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputName" name="name"
                                placeholder="vd: Nguyễn Văn A" required>
                        </div>
                        <div class="col-12">
                            <label for="inputEmail" class="form-label">Email (Nếu có)</label>
                            <input type="email" class="form-control" id="inputEmail" name="email"
                                placeholder="vd: email@gmail.com">
                        </div>
                        <div class="col-12">
                            <label for="inputPhone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputPhone" name="phone"
                                placeholder="vd: 0909090909" required>
                        </div>
                        <div class="col-12">
                            <label for="inputPassword" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control border-end-0" id="inputPassword" name="password"
                                    placeholder="Tối thiểu 6 ký tự" required>
                                <a href="javascript:;" class="input-group-text bg-transparent" tabindex="-1"><i
                                        class="bx bx-hide"></i></a>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="inputPasswordConfirm" class="form-label">Xác nhận mật khẩu <span
                                    class="text-danger">*</span></label>
                            <div class="input-group" id="show_hide_password_confirm">
                                <input type="password" class="form-control border-end-0" id="inputPasswordConfirm"
                                    name="password_confirmation" placeholder="Nhập lại mật khẩu" required>
                                <a href="javascript:;" class="input-group-text bg-transparent" tabindex="-1"><i
                                        class="bx bx-hide"></i></a>
                            </div>
                        </div>
                        <div class="col-12 pt-1">
                            <button type="submit" class="btn btn-client-primary w-100">
                                <i class="bx bx-user-plus me-1"></i>Đăng ký
                            </button>
                            <button type="button" class="btn btn-outline-secondary w-100 mt-2"
                                onclick="window.location.href='{{ url('/') }}'">Quay lại trang chủ</button>
                        </div>
                        <div class="col-12 text-center pt-2">
                            <span class="text-muted">Đã có tài khoản?</span>
                            <a class="client-auth-link ms-1" href="/user/login">Đăng nhập</a>
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
            function togglePassword(selector) {
                $(selector + ' a').on('click', function(e) {
                    e.preventDefault();
                    const input = $(selector + ' input');
                    const icon = $(selector + ' i');
                    if (input.attr('type') === 'text') {
                        input.attr('type', 'password');
                        icon.addClass('bx-hide').removeClass('bx-show');
                    } else {
                        input.attr('type', 'text');
                        icon.removeClass('bx-hide').addClass('bx-show');
                    }
                });
            }
            togglePassword('#show_hide_password');
            togglePassword('#show_hide_password_confirm');
        });
    </script>
@endsection
