  <div class="nav-container primary-menu">
      <div class="mobile-topbar-header">
          <div>
              <img src="/assets_client/images/logo-icon.png" class="logo-icon" alt="logo icon">
          </div>
          <div>
              <h4 class="logo-text">Rukada</h4>
          </div>
          <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
          </div>
      </div>
      <nav class="navbar navbar-expand-xl w-100">
          <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
              <li class="nav-item">
                  <a class="nav-link" href="/">
                      <div class="parent-icon"><i class="fas fa-home"></i></div>
                      <div class="menu-title">Trang chủ</div>
                  </a>
              </li>
              <li class="nav-item dropdown">
                  <a href="javascript:;" class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                      data-bs-toggle="dropdown">
                      <div class="parent-icon"><i class='bx bx-category'></i></div>
                      <div class="menu-title">Danh mục</div>
                  </a>
                  <ul class="dropdown-menu">
                      <li>
                          <a class="dropdown-item" href="#">
                              <i class="bx bx-right-arrow-alt"></i>Danh mục 1
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item" href="#">
                              <i class="bx bx-right-arrow-alt"></i>Danh mục 2
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item" href="#">
                              <i class="bx bx-right-arrow-alt"></i>Danh mục 3
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item" href="#">
                              <i class="bx bx-right-arrow-alt"></i>Danh mục 4
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item" href="#">
                              <i class="bx bx-right-arrow-alt"></i>Danh mục 5
                          </a>
                      </li>
                  </ul>
              </li>
          </ul>
          <hr class="my-2 d-xl-none w-100">
          <div class="text-center text-muted small d-xl-none w-100 mb-1">TÀI KHOẢN</div>
          <ul class="navbar-nav justify-content-end flex-grow-1 gap-1">
              <li class="nav-item">
                  <a class="nav-link" href="#">
                      <div class="parent-icon"><i class="fa-solid fa-right-to-bracket"></i></div>
                      <div class="menu-title">Đăng nhập</div>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">
                      <div class="parent-icon"><i class="fa-solid fa-user-plus"></i></div>
                      <div class="menu-title">Đăng kí</div>
                  </a>
              </li>

              {{-- Khi đã đăng nhập: ẩn 2 nút trên, hiển thị avatar + tên user có dropdown --}}
              {{-- <li class="nav-item dropdown">
                  <a href="javascript:;" class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                      data-bs-toggle="dropdown">
                      <div class="parent-icon"><img src="/assets_client/images/avatars/avatar-2.png" class="rounded-circle"
                              width="32" height="32" alt="avatar"></div>
                      <div class="menu-title ms-2"><b>Nguyễn Văn A</b></div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                      <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user me-2"></i>Tài khoản</a></li>
                      <li><a class="dropdown-item" href="#"><i class="fa-solid fa-cog me-2"></i>Cài đặt</a></li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      <li><a class="dropdown-item" href="#"><i class="fa-solid fa-right-from-bracket me-2"></i>Đăng
                              xuất</a></li>
                  </ul>
              </li> --}}

          </ul>
      </nav>
  </div>
