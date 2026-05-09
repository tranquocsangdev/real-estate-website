<footer class="market-footer">
    <div class="market-footer-top">
        <div class="container market-container">
            <div class="market-footer-newsletter">
                <div>
                    <h4>Nhận bản tin thị trường bất động sản mỗi tuần</h4>
                    <p>Cập nhật giá, khu vực hot, pháp lý và cơ hội đầu tư phù hợp.</p>
                </div>
                <form>
                    <input type="email" class="form-control" placeholder="Nhập email của bạn">
                    <button type="button" class="btn btn-primary">Đăng ký</button>
                </form>
            </div>
        </div>
    </div>

    <div class="market-footer-main">
        <div class="container market-container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <h5>{{ setting('site_name') }}</h5>
                    <p>Nền tảng kết nối mua bán, cho thuê và dự án bất động sản minh bạch, dữ liệu rõ ràng.</p>
                    <div class="market-footer-social">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="{{ setting('zalo') }}"><i class="fa-solid fa-comment-dots"></i></a>
                        <a href="{{ setting('youtube') }}"><i class="fa-brands fa-youtube"></i></a>
                        <a href="{{ setting('instagram') }}"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6>Danh mục BĐS</h6>
                    <ul>
                        <li><a href="#">Nhà phố</a></li>
                        <li><a href="#">Căn hộ</a></li>
                        <li><a href="#">Đất nền</a></li>
                        <li><a href="#">Biệt thự</a></li>
                        <li><a href="#">Văn phòng</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6>Khu vực phổ biến</h6>
                    <ul>
                        <li><a href="#">TP.HCM</a></li>
                        <li><a href="#">Hà Nội</a></li>
                        <li><a href="#">Đà Nẵng</a></li>
                        <li><a href="#">Bình Dương</a></li>
                        <li><a href="#">Bà Rịa - Vũng Tàu</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6>Tin tức & Wiki</h6>
                    <ul>
                        <li><a href="#">Tin thị trường</a></li>
                        <li><a href="#">Phân tích xu hướng</a></li>
                        <li><a href="#">Wiki pháp lý</a></li>
                        <li><a href="#">Cẩm nang mua nhà</a></li>
                        <li><a href="#">Kinh nghiệm đầu tư</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h6>Liên hệ</h6>
                    <ul class="market-footer-contact">
                        <li><i class="fa-solid fa-location-dot"></i><span>{{ setting('address') }}</span></li>
                        <li><i class="fa-solid fa-phone"></i><a href="tel:{{ setting('phone') }}">{{ setting('phone') }}</a></li>
                        <li><i class="fa-solid fa-envelope"></i><a href="mailto:{{ setting('email') }}">{{ setting('email') }}</a></li>
                        <li><i class="fa-regular fa-clock"></i><span>{{ setting('working_time') }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="market-footer-seo">
                <a href="#">Mua bán chung cư</a>
                <a href="#">Cho thuê nhà riêng</a>
                <a href="#">Mặt bằng thương mại</a>
                <a href="#">Dự án cao cấp</a>
                <a href="#">Đất nền vùng ven</a>
                <a href="#">Nhà phố trung tâm</a>
                <a href="#">Bất động sản nghỉ dưỡng</a>
            </div>
        </div>
    </div>

    <div class="market-footer-bottom">
        <div class="container market-container">
            <p>© {{ date('Y') }} {{ setting('site_name') }}. All rights reserved.</p>
            <div>
                <a href="#">Chính sách bảo mật</a>
                <a href="#">Điều khoản sử dụng</a>
                <a href="#">Quy chế hoạt động</a>
            </div>
        </div>
    </div>
</footer>
