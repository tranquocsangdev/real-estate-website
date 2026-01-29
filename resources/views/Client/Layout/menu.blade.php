<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm fixed-top" id="menuApp">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/"
                style="height: 47px; width: auto; padding: 0; display: flex; align-items: center;">
                <img src="/assets_client/images/logo.jpg" alt="Thùy Dung BĐS"
                    style="height: 40px; width: auto; border-radius: 6px; object-fit: contain; transition: all 0.3s ease;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- TRANG CHỦ -->
                    <li class="nav-item me-2">
                        <a class="nav-link fw-bold" href="/"
                            :class="{ active: window.location.pathname === '/' }">
                            Trang chủ
                        </a>
                    </li>
                    <!-- CATEGORY -->
                    <template v-for="(value, index) in list" :key="index">
                        <li class="nav-item dropdown me-2" v-if="value.subcategories && value.subcategories.length">

                            <a class="nav-link dropdown-toggle fw-bold" :class="{ active: isActiveCategory(value) }"
                                href="#" role="button" data-bs-toggle="dropdown">
                                @{{ value.name }}
                            </a>

                            <ul class="dropdown-menu">
                                <li v-for="sub in value.subcategories" :key="sub.sub_id">
                                    <a class="dropdown-item" :class="{ active: isActiveSub(sub.sub_slug) }"
                                        :href="'/home/category/' + sub.sub_slug">
                                        @{{ sub.sub_name }}
                                    </a>
                                </li>
                            </ul>

                        </li>
                    </template>

                </ul>

            </div>
        </div>
    </nav>
</header>
