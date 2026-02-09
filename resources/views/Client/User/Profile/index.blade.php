@extends('Client.Layout.master')

@section('title', 'Hồ sơ cá nhân')

@section('content')

<div class="container py-5">
    <div class="row g-4">

        <!-- SIDEBAR -->
        <div class="col-lg-3">

            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">

                    <img src="{{ asset('assets_client/images/avatars/avatar-2.png') }}"
                         class="rounded-circle mb-3"
                         width="100">

                    <h6 class="fw-bold mb-1">
                        {{ auth('khach_hangs')->user()->name }}
                    </h6>

                    <p class="text-muted small mb-3">
                        {{ auth('khach_hangs')->user()->email }}
                    </p>

                    <span class="badge bg-warning text-dark mb-3">
                        <i class="fa-solid fa-crown"></i> VIP Gold
                    </span>

                    <hr>

                    <a href="#" class="btn btn-outline-primary btn-sm w-100 mb-2">
                        <i class="fa-solid fa-pen"></i> Quản lý bài đăng
                    </a>

                    <a href="#" class="btn btn-outline-success btn-sm w-100">
                        <i class="fa-solid fa-wallet"></i> Mua VIP
                    </a>

                </div>
            </div>

        </div>

        <!-- MAIN CONTENT -->
        <div class="col-lg-9">

            <!-- STATS -->
            <div class="row g-3 mb-4">

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm text-center p-3">
                        <i class="fa-solid fa-file-lines fa-2x text-primary mb-2"></i>
                        <h5 class="fw-bold">12</h5>
                        <small class="text-muted">Bài đăng</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm text-center p-3">
                        <i class="fa-solid fa-ticket fa-2x text-success mb-2"></i>
                        <h5 class="fw-bold">3</h5>
                        <small class="text-muted">Còn lượt đăng</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm text-center p-3">
                        <i class="fa-solid fa-hourglass-half fa-2x text-danger mb-2"></i>
                        <h5 class="fw-bold">15</h5>
                        <small class="text-muted">Ngày VIP</small>
                    </div>
                </div>

            </div>

            <!-- PERSONAL INFO -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white fw-bold">
                    <i class="fa-solid fa-user"></i> Thông tin cá nhân
                </div>

                <div class="card-body">

                    <form class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Họ tên</label>
                            <input type="text" class="form-control"
                                   value="{{ auth('khach_hangs')->user()->name }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control"
                                   value="{{ auth('khach_hangs')->user()->email }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control"
                                   value="{{ auth('khach_hangs')->user()->phone }}">
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary">
                                <i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi
                            </button>
                        </div>

                    </form>

                </div>
            </div>

            <!-- VIP INFO -->
            <div class="card shadow-sm border-0">

                <div class="card-header bg-white fw-bold">
                    <i class="fa-solid fa-crown text-warning"></i> Gói VIP hiện tại
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div>
                            <h6 class="fw-bold text-warning mb-1">VIP Gold</h6>
                            <small class="text-muted">Hết hạn: 20/03/2026</small>
                        </div>

                        <a href="#" class="btn btn-outline-primary btn-sm">
                            Gia hạn VIP
                        </a>

                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fa-solid fa-check text-success"></i>
                            Đăng tối đa 20 bài
                        </li>
                        <li class="list-group-item">
                            <i class="fa-solid fa-check text-success"></i>
                            Mỗi bài sống 15 ngày
                        </li>
                        <li class="list-group-item">
                            <i class="fa-solid fa-check text-success"></i>
                            Ưu tiên hiển thị
                        </li>
                        <li class="list-group-item">
                            <i class="fa-solid fa-check text-success"></i>
                            Hỗ trợ nhanh
                        </li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
