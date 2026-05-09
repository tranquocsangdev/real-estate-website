@extends('Client.Layout.master')

@section('title', 'Trang chủ')

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

                            <img src="{{ asset($value->image) }}"
                                class="smart-banner d-block w-100"
                                alt="Hero Banner {{ $key + 1 }}">

                        </div>
                    @empty
                        <div class="carousel-item active">

                            <img src="/assets_client/images/banner/banner4.png"
                                class="smart-banner d-block w-100"
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
                <div class="market-search-card">
                    <div class="market-search-tabs">
                        <button class="active">Mua bán</button>
                        <button>Cho thuê</button>
                        <button>Dự án</button>
                    </div>
                    <div class="market-search-main">
                        <div class="market-input-wrap">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input id="heroSearchInput" type="text"
                                placeholder="Nhập từ khóa: dự án, quận huyện, tuyến đường...">
                            <div id="searchSuggestionBox" class="market-suggestion-box d-none"></div>
                        </div>
                        <button type="button">Tìm kiếm</button>
                    </div>
                    <div class="market-filter-row">
                        <select>
                            <option>Thành phố</option>
                            <option>TP.HCM</option>
                            <option>Hà Nội</option>
                            <option>Đà Nẵng</option>
                        </select>
                        <select>
                            <option>Quận huyện</option>
                            <option>Quận 1</option>
                            <option>Quận 7</option>
                            <option>Hải Châu</option>
                        </select>
                        <select>
                            <option>Giá</option>
                            <option>Dưới 2 tỷ</option>
                            <option>2 - 5 tỷ</option>
                            <option>Trên 5 tỷ</option>
                        </select>
                        <select>
                            <option>Diện tích</option>
                            <option>Dưới 50m2</option>
                            <option>50 - 100m2</option>
                            <option>Trên 100m2</option>
                        </select>
                        <select>
                            <option>Loại bất động sản</option>
                            <option>Căn hộ</option>
                            <option>Nhà phố</option>
                            <option>Đất nền</option>
                        </select>
                    </div>
                </div>
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
                <div id="marketPropertyGrid" class="market-grid d-none">
                    @forelse ($ds_post as $value)
                        <article class="market-property-card">
                            <div class="market-property-thumb">
                                <img src="{{ $value->thumbnail }}" alt="{{ $value->title }}">
                                <span class="badge hot">Hot</span>
                                <button class="favorite"><i class="fa-regular fa-heart"></i></button>
                            </div>
                            <div class="market-property-body">
                                <h3 title="{{ $value->title }}">{{ $value->title }}</h3>
                                <div class="price">{{ number_format($value->price, 0, ',', '.') }} VNĐ</div>
                                <div class="meta">
                                    <span><i class="fa-solid fa-vector-square"></i> 80 m2</span>
                                    <span><i class="fa-solid fa-bed"></i> 3 PN</span>
                                </div>
                                <p class="address"><i class="fa-solid fa-location-dot"></i> {{ $value->address }}</p>
                                <a href="/home/post/{{ $value->slug }}/{{ $value->id }}">Xem chi tiết</a>
                            </div>
                        </article>
                    @empty
                        <div class="market-empty">Chưa có bất động sản hiển thị.</div>
                    @endforelse
                </div>
            </section>

            <section class="market-section market-overview fade-up">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div class="market-section-card">
                            <div class="market-section-head mb-3">
                                <div>
                                    <h2>Dự án nổi bật</h2>
                                    <p>Dự án tiềm năng với pháp lý rõ ràng, hạ tầng tốt.</p>
                                </div>
                            </div>
                            <div class="market-mini-grid">
                                <div class="market-mini-card">
                                    <h4>Sunrise Riverside</h4>
                                    <p>Quận 7 - Tỷ lệ hấp thụ 86%</p>
                                </div>
                                <div class="market-mini-card">
                                    <h4>Vinhomes Grand Park</h4>
                                    <p>TP. Thủ Đức - Giá từ 2.8 tỷ</p>
                                </div>
                                <div class="market-mini-card">
                                    <h4>The River Thu Thiem</h4>
                                    <p>TP. Thủ Đức - Cao cấp ven sông</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="market-section-card h-100">
                            <div class="market-section-head mb-3">
                                <div>
                                    <h2>Nhà đất theo khu vực</h2>
                                    <p>Khám phá nguồn hàng theo từng cụm thị trường.</p>
                                </div>
                            </div>
                            <div class="market-area-list">
                                <a href="#">TP.HCM (2,540)</a>
                                <a href="#">Hà Nội (1,920)</a>
                                <a href="#">Đà Nẵng (860)</a>
                                <a href="#">Bình Dương (640)</a>
                                <a href="#">Đồng Nai (520)</a>
                                <a href="#">Long An (410)</a>
                            </div>
                        </div>
                    </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const suggestions = [
                'Căn hộ Quận 7',
                'Nhà phố Thủ Đức',
                'Đất nền Long An',
                'Cho thuê căn hộ Hà Nội',
                'Dự án ven sông'
            ];
            const input = document.getElementById('heroSearchInput');
            const box = document.getElementById('searchSuggestionBox');

            if (input && box) {
                input.addEventListener('input', function() {
                    const keyword = input.value.trim().toLowerCase();
                    if (!keyword) {
                        box.classList.add('d-none');
                        box.innerHTML = '';
                        return;
                    }
                    const filtered = suggestions.filter(item => item.toLowerCase().includes(keyword)).slice(
                        0, 5);
                    if (!filtered.length) {
                        box.classList.add('d-none');
                        box.innerHTML = '';
                        return;
                    }
                    box.innerHTML = filtered.map(item => `<button type="button">${item}</button>`).join('');
                    box.classList.remove('d-none');
                });

                box.addEventListener('click', function(e) {
                    if (e.target.tagName === 'BUTTON') {
                        input.value = e.target.textContent;
                        box.classList.add('d-none');
                    }
                });

                document.addEventListener('click', function(e) {
                    if (!box.contains(e.target) && e.target !== input) {
                        box.classList.add('d-none');
                    }
                });
            }

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
