<header>
    <div class="topbar d-flex align-items-center"
        style="background: linear-gradient(135deg, #0f2027, #203a43, #2c5364); border-bottom: none;">
        <nav class="navbar navbar-expand w-100 px-3">

            <div class="topbar-logo-header d-flex align-items-center" style="border-color: rgba(255,255,255,0.2);">
                <div>
                    <a href="/">
                        <img src="/assets_client/images/logo.jpg" class="logo-icon rounded-5" alt="Logo"
                            style="width: 42px; height: auto;">
                    </a>
                </div>
                <div>
                    <h4 class="logo-text text-white mb-0 ms-2"
                        style="color: #fff !important; font-size: 1.25rem; letter-spacing: 1px;">
                        THUYDUNGBDS
                    </h4>
                </div>
            </div>

            <div class="mobile-toggle-menu text-white ms-auto" style="cursor: pointer;" title="Mở menu">
                <i class='bx bx-menu' style="font-size: 26px;"></i>
            </div>

            <div class="topbar-info-right ms-auto d-none d-lg-flex align-items-center gap-4 text-white small">
                <span>
                    <i class='bx bx-phone me-1'></i> {{ setting('phone') }}
                </span>
                <span>
                    <i class='bx bx-current-location me-1'></i> {{ setting('address') }}
                </span>
                <span>
                    <i class='bx bx-time-five me-1'></i> {{ setting('working_time') }}
                </span>
            </div>

            <div class="header-message-list d-none" aria-hidden="true"></div>
            <div class="header-notifications-list d-none" aria-hidden="true"></div>

        </nav>
    </div>
</header>
