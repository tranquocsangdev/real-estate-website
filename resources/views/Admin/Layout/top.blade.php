<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="topbar-logo-header">
                <div class="">
                    <img src="https://img.freepik.com/free-vector/business-user-cog_78370-7040.jpg?semt=ais_hybrid&w=740&q=80"
                        class="logo-icon spinner-border text-light" alt="logo icon">
                </div>
                <div class="">
                    <h4 class="logo-text">Admin Panel</h4>
                </div>
            </div>
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
            <div class="search-bar flex-grow-1">
                <div class="position-relative search-bar-box">
                    <input type="text" class="form-control search-control" placeholder="Type to search..."> <span
                        class="position-absolute top-50 search-show translate-middle-y"><i
                            class='bx bx-search'></i></span>
                    <span class="position-absolute top-50 search-close translate-middle-y"><i
                            class='bx bx-x'></i></span>
                </div>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mobile-search-icon">
                        <a class="nav-link" href="#"> <i class='bx bx-search'></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"> <i class='bx bx-category'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="row row-cols-3 g-3 p-3">
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-cosmic text-white"><i
                                            class='bx bx-group'></i>
                                    </div>
                                    <div class="app-title">Teams</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-burning text-white"><i
                                            class='bx bx-atom'></i>
                                    </div>
                                    <div class="app-title">Projects</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-lush text-white"><i
                                            class='bx bx-shield'></i>
                                    </div>
                                    <div class="app-title">Tasks</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-kyoto text-dark"><i
                                            class='bx bx-notification'></i>
                                    </div>
                                    <div class="app-title">Feeds</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-blues text-dark"><i class='bx bx-file'></i>
                                    </div>
                                    <div class="app-title">Files</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-moonlit text-white"><i
                                            class='bx bx-filter-alt'></i>
                                    </div>
                                    <div class="app-title">Alerts</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large" id="notification-app">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count"
                                v-if="tong_thong_bao > 0">@{{ tong_thong_bao }}</span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Thông báo</p>
                                    <p class="msg-header-clear ms-auto">Đánh dấu tất cả đã đọc</p>
                                </div>
                            </a>
                            <div class="header-notifications-list">
                                <template v-if="list_notifications.length > 0">
                                    <template v-for="(value, index) in list_notifications">
                                        <a class="dropdown-item" :class="{ 'bg-unread': value.is_read == 0 }" href="javascript:;" v-on:click="markAsRead(value)">
                                            <div class="d-flex align-items-center">
                                                <div class="user-online">
                                                    <img src="/assets_admin/images/avatars/avatar-1.png"
                                                        class="msg-avatar" alt="user avatar">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">@{{ value.tieu_de }} <span
                                                            class="msg-time float-end">@{{ moment(value.created_at).format('[Lúc: ]HH:mm:ss') }}
                                                        </span></h6>
                                                    <p class="msg-info text-muted">@{{ value.noi_dung }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </template>
                                </template>
                                <template v-else>
                                    <div class="text-center">
                                        <i class="bx bx-bell"></i>
                                        <p class="text-muted">Bạn không có thông báo nào. Khi có thông báo mới, chúng tôi sẽ thông báo cho bạn.</p>
                                        <a href="/admin/notifications" class="btn btn-primary">Xem tất cả thông báo</a>
                                    </div>
                                </template>
                            </div>
                            <a href="/admin/notifications">
                                <div class="text-center msg-footer">Xem tất cả thông báo</div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if ($adminLogin && $adminLogin->avatar)
                        <img src="{{ $adminLogin->avatar }}" class="user-img rounded-circle" alt="user avatar"
                            width="40" height="40">
                    @else
                        <img src="{{ asset('assets_admin/images/avatars/default-avatar.png') }}"
                            class="user-img rounded-circle" alt="default avatar" width="40" height="40">
                    @endif

                    <div class="user-info ps-3">
                        @if ($adminLogin)
                            <h6 class="mb-0 fw-bold">{{ $adminLogin->name }}</h6>
                            <p class="designation mb-0 text-muted">Quản trị viên</p>
                        @else
                            <h6 class="mb-0 fw-bold">Chưa đăng nhập</h6>
                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/admin/profile"><i
                                class="bx bx-user"></i><span>Profile</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li><a class="dropdown-item" href="/admin/logout"><i
                                class='bx bx-log-out-circle'></i><span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
