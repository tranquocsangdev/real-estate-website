<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nguyễn Thị Thùy Dung - Bán đất Hòa Phước</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* CSS tùy chỉnh - Tăng tính thẩm mỹ và cố định menu */
        :root {
            --bs-primary: #004c4c;
            /* Màu xanh đậm hơn, sang trọng hơn */
            --bs-success: #00a877;
            /* Màu xanh lá cây thân thiện hơn */
            --bs-body-color: #333;
            --bs-body-font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            font-family: var(--bs-body-font-family);
            padding-top: 60px;
            /* Bắt buộc cho sticky header */
            background-color: #f4f7f6;
            /* Nền xám nhạt */
        }

        .navbar-brand .logo-text {
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        /* Hero Section */
        .hero-section {
            background: url('https://picsum.photos/1600/600?random=datnen') no-repeat center center;
            /* Ảnh nền placeholder */
            background-size: cover;
            height: 450px;
            /* Tăng chiều cao */
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            padding-top: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.45);
            /* Lớp phủ mờ */
            z-index: 1;
        }

        .hero-content {
            z-index: 2;
        }

        /* Filter Toolbar - Box nổi bật */
        .filter-toolbar {
            margin-top: -60px;
            /* Đẩy toolbar lên trên Hero */
            position: relative;
            z-index: 10;
        }

        /* Card Listing */
        .card-img-top {
            height: 220px;
            object-fit: cover;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .badge.bg-success {
            background-color: var(--bs-success) !important;
        }

        /* ================= MENU PREMIUM ================= */
        #menuApp {
            background: #ffffff !important;
            border-bottom: 1px solid #eee;
            transition: all 0.3s ease;
        }

        /* Logo */
        #menuApp .navbar-brand img {
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        /* Menu list */
        #menuApp .navbar-nav {
            gap: 6px;
        }

        /* Menu item */
        #menuApp .nav-link {
            font-size: 15px;
            font-weight: 600;
            color: #333 !important;
            padding: 10px 16px;
            border-radius: 999px;
            transition: all 0.25s ease;
        }

        /* Hover menu */
        #menuApp .nav-link:hover {
            background: rgba(0, 76, 76, 0.08);
            color: #004c4c !important;
        }

        /* Active menu */
        #menuApp .nav-link.active {
            background: #004c4c;
            color: #fff !important;
        }

        /* Dropdown toggle arrow */
        #menuApp .dropdown-toggle::after {
            margin-left: 6px;
            transition: transform 0.25s ease;
        }

        /* Rotate arrow when open */
        #menuApp .show>.dropdown-toggle::after {
            transform: rotate(180deg);
        }

        /* Dropdown menu box */
        #menuApp .dropdown-menu {
            border: none;
            border-radius: 14px;
            padding: 10px;
            margin-top: 10px;
            min-width: 220px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
            animation: dropdownScale 0.25s ease;
        }

        /* Dropdown item */
        #menuApp .dropdown-item {
            font-size: 14px;
            font-weight: 500;
            padding: 10px 14px;
            border-radius: 10px;
            color: #333;
            transition: all 0.2s ease;
        }

        /* Hover dropdown */
        #menuApp .dropdown-item:hover {
            background: rgba(0, 76, 76, 0.08);
            color: #004c4c;
        }

        /* Active dropdown */
        #menuApp .dropdown-item.active {
            background: #004c4c;
            color: #fff;
        }

        /* Animation dropdown */
        @keyframes dropdownScale {
            from {
                opacity: 0;
                transform: scale(0.96) translateY(6px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* Mobile */
        @media (max-width: 991px) {
            #menuApp .navbar-collapse {
                background: #fff;
                border-radius: 16px;
                padding: 12px;
                margin-top: 12px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            }

            #menuApp .nav-link {
                border-radius: 12px;
            }
        }
    </style>
</head>

<body>
    <div>
        @include('Client.Layout.menu')
        <section class="hero-section">
            <div class="hero-overlay"></div>
            <div class="container hero-content">
                <h1 class="display-4 fw-bolder mb-3 text-uppercase">Bán đất Hòa Phước — Đà Nẵng</h1>
                <p class="lead fw-light">Cơ hội đầu tư vàng tại khu vực phát triển nhất phía Nam Đà Nẵng.</p>
            </div>
        </section>

        <main class="container mb-5">
            @yield('content')
        </main>

        @include('Client.Layout.footer')
    </div>

    @include('Client.Layout.js')
    @yield('js')
    <script>
        new Vue({
            el: '#menuApp',
            data: {
                list: [],
            },
            created() {
                this.loadDataCategoryHome();
            },
            methods: {
                loadDataCategoryHome() {
                    axios
                        .get('/home/category/data')
                        .then((res) => {
                            this.list = res.data.data;
                        })
                },
                isActiveSub(subSlug) {
                    return window.location.pathname === '/home/category/' + subSlug;
                },

                isActiveCategory(category) {
                    if (!category.subcategories) return false;

                    return category.subcategories.some(sub =>
                        this.isActiveSub(sub.sub_slug)
                    );
                }
            }
        });
    </script>
</body>

</html>
