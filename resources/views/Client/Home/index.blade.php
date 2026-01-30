@extends('Client.Layout.master')

@section('title', 'Trang chủ')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div id="carouselHero" class="carousel slide rounded-3 overflow-hidden shadow" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/assets_client/images/banner/banner4.png" class="d-block w-100" alt="Banner 1">
                    </div>
                    <div class="carousel-item">
                        <img src="/assets_client/images/banner/banner5.png" class="d-block w-100" alt="Banner 2">
                    </div>
                    <div class="carousel-item">
                        <img src="/assets_client/images/banner/banner6.png" class="d-block w-100" alt="Banner 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselHero" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselHero" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row justify-content-center mt-3">
                <div class="col-12">
                    <div class="card shadow border-0 rounded-3 mt-n4 position-relative z-1">
                        <div class="card-body p-4">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-3">
                                    <label class="form-label small text-muted fw-semibold mb-1">Loại hình</label>
                                    <select class="form-select">
                                        <option>Tất cả</option>
                                        <option>Đất nền</option>
                                        <option>Nhà phố</option>
                                        <option>Căn hộ</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small text-muted fw-semibold mb-1">Khu vực</label>
                                    <select class="form-select">
                                        <option>Toàn quốc</option>
                                        <option>TP. Hồ Chí Minh</option>
                                        <option>Hà Nội</option>
                                        <option>Đà Nẵng</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small text-muted fw-semibold mb-1">Mức giá</label>
                                    <select class="form-select">
                                        <option>Chọn giá</option>
                                        <option>Dưới 1 tỷ</option>
                                        <option>1 - 3 tỷ</option>
                                        <option>3 - 5 tỷ</option>
                                        <option>Trên 5 tỷ</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-primary w-100">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <p class="text-primary fw-semibold small mb-1">Bất động sản nổi bật</p>
            <h2 class="h3 fw-bold mb-2">Tin đăng mới nhất</h2>
            <p class="text-muted mb-4">Những sản phẩm đất nền, nhà phố được cập nhật liên tục từ đối tác uy tín.</p>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border shadow-sm rounded-3 overflow-hidden">
                        <div class="position-relative ratio ratio-4x3">
                            <img src="/assets_client/images/banner/banner4.png" class="card-img-top object-fit-cover"
                                alt="Đất nền">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title h6 fw-semibold">Đất nền mặt tiền đường 20m, quận 9</h5>
                            <p class="card-text small text-muted mb-2"><i class="fas fa-map-marker-alt me-1"></i> Quận
                                9,
                                TP. Hồ Chí Minh</p>
                            <div class="small text-muted d-flex gap-3">
                                <span><i class="fas fa-ruler-combined me-1"></i> 100 m²</span>
                                <span><i class="fas fa-bed me-1"></i> 2 phòng</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-outline-primary">Xem tất cả tin đăng</a>
            </div>
        </div>
        <div class="col-lg-12 py-5 bg-light">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <h2 class="h3 fw-bold mb-3">Vì sao chọn chúng tôi?</h2>
                        <p class="text-muted mb-4">Chúng tôi cam kết mang đến trải nghiệm mua bán bất động sản minh bạch,
                            nhanh
                            chóng và an toàn pháp lý.</p>
                        <ul class="list-unstyled mb-4">
                            <li class="d-flex align-items-center mb-3">
                                <button class="btn btn-success rounded-circle">✓</button>
                                <span class="ms-2"> Kiểm tra pháp lý, sổ đỏ rõ ràng</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <button class="btn btn-success rounded-circle">✓</button>
                                <span class="ms-2"> Tư vấn miễn phí 24/7</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <button class="btn btn-success rounded-circle">✓</button>
                                <span class="ms-2"> Giao dịch bảo đảm, uy tín</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <button class="btn btn-success rounded-circle">✓</button>
                                <span class="ms-2">Hỗ trợ vay vốn ngân hàng</span>
                            </li>
                        </ul>
                        <a href="#" class="btn btn-primary">Tìm hiểu thêm</a>
                    </div>
                    <div class="col-lg-6">
                        <img src="/assets_client/images/banner/banner4.png"
                            class="img-fluid rounded-3 shadow object-fit-cover w-100" alt="Giới thiệu">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="container">
                <div class="row g-4 text-center">
                    <div class="col-6 col-md-3">
                        <div class="card border-0 h-100 py-4">
                            <div class="card-body">
                                <span class="fs-2 fw-bold text-primary d-block">5.000+</span>
                                <small class="text-muted">Tin đăng</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 h-100 py-4">
                            <div class="card-body">
                                <span class="fs-2 fw-bold text-primary d-block">2.000+</span>
                                <small class="text-muted">Khách hàng</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 h-100 py-4">
                            <div class="card-body">
                                <span class="fs-2 fw-bold text-primary d-block">50+</span>
                                <small class="text-muted">Đối tác</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm h-100 py-4">
                            <div class="card-body">
                                <span class="fs-2 fw-bold text-primary d-block">98%</span>
                                <small class="text-muted">Hài lòng</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
