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
                    <template v-for="(value, index) in list">
                        <li class="nav-item dropdown me-2">
                            <a class="nav-link dropdown-toggle fw-bold" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @{{ value.name }}
                            </a>

                            <ul class="dropdown-menu" v-if="value.subcategories && value.subcategories.length > 0">
                                <li v-for="sub in value.subcategories" :key="sub.sub_id">
                                    <a class="dropdown-item"
                                        :href="'/home/category/' + sub.sub_slug">@{{ sub.sub_name }}</a>
                                </li>
                            </ul>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</header>
