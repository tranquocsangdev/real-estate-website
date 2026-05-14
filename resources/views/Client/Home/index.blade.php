@extends('Client.Layout.master')

@section('title', 'Trang chủ')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css">
@endsection

@section('content')
    <div class="market-home">
        <section class="fade-up">
            <div id="heroCarousel" class="carousel slide carousel-fade overflow-hidden" data-bs-ride="carousel"
                data-bs-interval="4500">
                <div class="carousel-indicators">
                    @forelse ($ds_banner as $key => $value)
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $key }}"
                            class="{{ $key === 0 ? 'active' : '' }}" aria-current="{{ $key === 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $key + 1 }}"></button>
                    @empty
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                    @endforelse
                </div>
                <div class="carousel-inner">
                    @forelse ($ds_banner as $key => $value)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">

                            <img src="{{ asset($value->image) }}" class="smart-banner d-block w-100"
                                alt="Hero Banner {{ $key + 1 }}">

                        </div>
                    @empty
                        <div class="carousel-item active">

                            <img src="/assets_client/images/banner/banner4.png" class="smart-banner d-block w-100"
                                alt="Hero Banner">

                        </div>
                    @endforelse
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <div class="container market-container">
            <section class="market-search-section fade-up">
                <form method="get" action="/home/all-post" class="market-search-card" id="homeQuickSearchForm">
                    <div class="market-search-main">
                        <div class="market-input-wrap">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>
                            <input type="text" name="q" value="{{ request('q') }}"
                                placeholder="Nhập từ khóa: dự án, địa chỉ, tuyến đường...">
                        </div>
                        <button type="submit">Tìm kiếm</button>
                    </div>
                    <div class="market-filter-row">
                        <select name="id_tinh_thanh" id="homeSearchTinh" class="form-select" autocomplete="address-level1">
                            <option value="">-- Tỉnh / Thành phố --</option>
                        </select>
                        <select name="id_xa_phuong" id="homeSearchXa" class="form-select" autocomplete="address-level2">
                            <option value="">-- Xã / Phường --</option>
                        </select>
                        <select name="price_band" class="form-select">
                            <option value="">Giá</option>
                            <option value="lt1" @selected(request('price_band') === 'lt1')>Dưới 1 tỷ</option>
                            <option value="1to2" @selected(request('price_band') === '1to2')>1 tỷ đến 2 tỷ</option>
                            <option value="2to5" @selected(request('price_band') === '2to5')>2 tỷ đến 5 tỷ</option>
                            <option value="gt5" @selected(request('price_band') === 'gt5')>Trên 5 tỷ</option>
                        </select>
                        <select name="area_band" class="form-select">
                            <option value="">Diện tích</option>
                            <option value="lt100" @selected(request('area_band') === 'lt100')>Dưới 100m²</option>
                            <option value="100to200" @selected(request('area_band') === '100to200')>100m² đến 200m²</option>
                            <option value="200to500" @selected(request('area_band') === '200to500')>200m² đến 500m²</option>
                            <option value="gt500" @selected(request('area_band') === 'gt500')>Trên 500m²</option>
                        </select>
                    </div>
                    <div class="market-search-filter-actions">
                        <button type="submit" class="market-filter-submit-btn">Tìm kiếm</button>
                    </div>
                </form>
            </section>

            <section class="market-section market-featured fade-up">
                <div class="market-section-head">
                    <div>
                        <h2>Bất động sản nổi bật</h2>
                        <p>Tin đăng chất lượng cao, minh bạch thông tin, dễ so sánh.</p>
                    </div>
                    <a href="/home/all-post">Xem tất cả</a>
                </div>
                <div id="marketSkeleton" class="market-grid market-skeleton-grid">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="market-skeleton-card"></div>
                    @endfor
                </div>
                <div id="marketPropertyGrid" class="row g-3 d-none">
                    @forelse ($ds_post->take(4) as $value)
                        <div class="col-6 col-lg-3">
                            <a href="/home/post/{{ $value->slug }}/{{ $value->id }}">
                                <article class="card h-100 border-0 shadow-sm">
                                    <img src="{{ $value->thumbnail }}" class="card-img-top" alt="{{ $value->title }}">
                                    <div class="card-body">
                                        <h5 class="card-title" title="{{ $value->title }}">{{ $value->title }}</h5>
                                        <p class="card-text mb-2 text-muted">{{ $value->address }}</p>
                                        <p class="card-text fw-semibold text-danger mb-0">
                                            {{ number_format($value->price, 0, ',', '.') }} VNĐ
                                        </p>
                                    </div>
                                </article>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="market-empty">Chưa có bất động sản hiển thị.</div>
                        </div>
                    @endforelse
                </div>
            </section>


            <section class="market-section market-news-stack fade-up">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div class="market-section-card h-100">
                            <div class="market-section-head mb-3">
                                <div>
                                    <h2>Tin mới đăng</h2>
                                    <p>Danh sách cập nhật theo thời gian thực.</p>
                                </div>
                            </div>
                            <div class="market-list-card">
                                @foreach ($ds_post as $value)
                                    <a href="/home/post/{{ $value->slug }}/{{ $value->id }}">
                                        <span>{{ $value->title }}</span>
                                        <strong>{{ number_format($value->price, 0, ',', '.') }} VNĐ</strong>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="market-section-card h-100">
                            <div class="market-section-head mb-3">
                                <div>
                                    <h2>Bất động sản cao cấp</h2>
                                    <p>Danh mục lựa chọn dành cho khách hàng premium.</p>
                                </div>
                            </div>
                            <div class="market-mini-grid">
                                <div class="market-mini-card premium">
                                    <h4>Penthouse trung tâm</h4>
                                    <p>Giá từ 18 tỷ - Full nội thất</p>
                                </div>
                                <div class="market-mini-card premium">
                                    <h4>Villa compound</h4>
                                    <p>Giá từ 25 tỷ - Bảo mật 24/7</p>
                                </div>
                                <div class="market-mini-card premium">
                                    <h4>Biệt thự ven sông</h4>
                                    <p>Giá từ 32 tỷ - Số lượng giới hạn</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="market-section fade-up">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div class="market-section-card h-100">
                            <h2>Tin tức thị trường</h2>
                            <div class="market-article-card">
                                <h4>Giá căn hộ khu Đông tăng nhẹ quý II</h4>
                                <p>Nhu cầu thực và hạ tầng mới đang thúc đẩy thanh khoản trở lại.</p>
                            </div>
                            <div class="market-article-card">
                                <h4>Tín hiệu tích cực từ phân khúc cho thuê</h4>
                                <p>Tỷ lệ lấp đầy tăng, dòng tiền thuê cải thiện so với năm trước.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="market-section-card h-100">
                            <h2>Wiki bất động sản</h2>
                            <div class="market-article-card">
                                <h4>Checklist pháp lý trước khi đặt cọc</h4>
                                <p>Các giấy tờ cần kiểm tra để hạn chế rủi ro giao dịch.</p>
                            </div>
                            <div class="market-article-card">
                                <h4>Cách định giá nhà phố theo dữ liệu khu vực</h4>
                                <p>Phương pháp so sánh theo biên độ giá và tính thanh khoản.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="market-cta-post fade-up">
                <h3>Bạn là môi giới hoặc chủ nhà?</h3>
                <p>Đăng tin ngay để tiếp cận hàng nghìn khách hàng đang có nhu cầu thực.</p>
                <a href="javascript:;">Đăng tin ngay</a>
            </section>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const skeleton = document.getElementById('marketSkeleton');
            const propertyGrid = document.getElementById('marketPropertyGrid');
            setTimeout(function() {
                if (skeleton && propertyGrid) {
                    skeleton.classList.add('d-none');
                    propertyGrid.classList.remove('d-none');
                }
            }, 650);

            const fadeElements = document.querySelectorAll('.fade-up');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('show');
                    }
                });
            }, {
                threshold: 0.14
            });
            fadeElements.forEach(el => observer.observe(el));

            const tinhEl = document.getElementById('homeSearchTinh');
            const xaEl = document.getElementById('homeSearchXa');
            if (!tinhEl || !xaEl || typeof TomSelect === 'undefined') {
                return;
            }

            const tinhOptions = @json($list_tinh_thanh_options);
            const presetTinh = @json((string) request('id_tinh_thanh', ''));
            const presetXa = @json((string) request('id_xa_phuong', ''));

            let tsTinh = null;
            let tsXa = null;

            function refreshXaOptions(idTinh) {
                if (!tsXa) {
                    return Promise.resolve();
                }
                tsXa.clear(true);
                tsXa.clearOptions();
                if (!idTinh) {
                    return Promise.resolve();
                }
                return fetch('/home/dia-phan/xa-phuong?id_tinh_thanh=' + encodeURIComponent(idTinh))
                    .then(function(res) {
                        return res.json();
                    })
                    .then(function(body) {
                        const rows = body.data || [];
                        rows.forEach(function(row) {
                            tsXa.addOption({
                                id: String(row.id),
                                name: row.name
                            });
                        });
                        tsXa.refreshOptions(false);
                    })
                    .catch(function() {
                        tsXa.clear(true);
                        tsXa.clearOptions();
                    });
            }

            tsXa = new TomSelect(xaEl, {
                plugins: ['clear_button'],
                maxOptions: 20000,
                valueField: 'id',
                labelField: 'name',
                searchField: ['name'],
                options: [],
                placeholder: 'Tìm xã / phường...',
            });

            tsTinh = new TomSelect(tinhEl, {
                plugins: ['clear_button'],
                maxOptions: 10000,
                valueField: 'id',
                labelField: 'name',
                searchField: ['name'],
                options: tinhOptions,
                placeholder: 'Tìm tỉnh / thành phố...',
                onChange: function(val) {
                    refreshXaOptions(val);
                },
            });

            if (presetTinh) {
                tsTinh.setValue(presetTinh, true);
                refreshXaOptions(presetTinh).then(function() {
                    if (presetXa) {
                        tsXa.setValue(presetXa, true);
                    }
                });
            }
        });
    </script>
    <style>
        .banner-wrapper {
            width: 100%;
            height: 60vh;

            background: #111;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;
            border-radius: 16px;
        }

        .banner-img {
            max-width: 100%;
            max-height: 100%;

            object-fit: contain;
        }

        @media(max-width:768px) {
            .banner-wrapper {
                height: 35vh;
            }
        }
    </style>
@endsection
