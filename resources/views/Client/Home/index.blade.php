@extends('Client.Layout.master')

@section('title', 'Trang chủ')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div id="carouselHero" class="carousel slide rounded-3 overflow-hidden shadow" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets_client/images/banner/banner4.png') }}" class="d-block w-100" alt="Banner 1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets_client/images/banner/banner5.png') }}" class="d-block w-100"
                            alt="Banner 2">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets_client/images/banner/banner6.png') }}" class="d-block w-100"
                            alt="Banner 3">
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
                                    <div class="cta-actions">
                                        <button type="button" class="btn btn-cta-pro btn-cta-pro--amber w-100"><i
                                                class="fas fa-search me-1"></i> Tìm kiếm
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="mb-3">
                        <small class="text-primary fw-semibold d-block mb-1">
                            BẤT ĐỘNG SẢN NỔI BẬT
                        </small>

                        <h3 class="fw-bold mb-1">
                            Tin đăng mới nhất
                        </h3>

                        <p class="text-muted small mb-0">
                            Cập nhật nhanh – thông tin rõ ràng – dễ lựa chọn.
                        </p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($ds_post as $key => $value)
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
                                @endforeach
                                @if ($ds_post->isEmpty())
                                    <div class="col-lg-12 text-center py-5 ">
                                        <h5 class="text-center text-muted">Không có bất động sản nào</h5>
                                        <div class="mt-3">
                                            <i class="bx bx-search-alt-2 fs-1"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-12 text-center mb-3">
                <div class="cta-actions ">
                    <button type="button" class="btn btn-cta-pro btn-cta-pro--emerald" onclick="window.location.href='/all-post'">Xem tất cả tin đăng
                    </button>
                </div>
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
                        <div class="col-md-12">
                            <div class="cta-actions">
                                <button type="button" class="btn btn-cta-pro btn-cta-pro--emerald w-50"><i
                                        class="fas fa-arrow-right me-1"></i> Tìm hiểu thêm
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="/assets_client/images/banner/banner4.png"
                            class="img-fluid rounded-3 shadow object-fit-cover w-100" alt="Giới thiệu">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row row-cols-1 row-cols-md-3 row-cols-xl-5">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="widgets-icons rounded-circle mx-auto bg-light-primary text-primary mb-3"><i
                                        class="bx bxl-facebook-square"></i>
                                </div>
                                <h4 class="my-1">84K</h4>
                                <p class="mb-0 text-secondary">Facebook Users</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="widgets-icons rounded-circle mx-auto bg-light-danger text-danger mb-3"><i
                                        class="bx bxl-twitter"></i>
                                </div>
                                <h4 class="my-1">34M</h4>
                                <p class="mb-0 text-secondary">Twitter Followers</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="widgets-icons rounded-circle mx-auto bg-light-info text-info mb-3"><i
                                        class="bx bxl-linkedin-square"></i>
                                </div>
                                <h4 class="my-1">56K</h4>
                                <p class="mb-0 text-secondary">Linkedin Followers</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="widgets-icons rounded-circle mx-auto bg-light-success text-success mb-3"><i
                                        class="bx bxl-youtube"></i>
                                </div>
                                <h4 class="my-1">38M</h4>
                                <p class="mb-0 text-secondary">YouTube Subscribers</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="widgets-icons rounded-circle mx-auto bg-light-warning text-warning mb-3"><i
                                        class="bx bxl-dropbox"></i>
                                </div>
                                <h4 class="my-1">28K</h4>
                                <p class="mb-0 text-secondary">Dropbox Users</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
