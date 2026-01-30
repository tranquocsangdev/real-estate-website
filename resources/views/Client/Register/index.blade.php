<!doctype html>
<html lang="vi">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="{{ setting('favicon') }}" type="image/png" />
	<link href="/assets_client/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="/assets_client/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="/assets_client/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="/assets_client/css/pace.min.css" rel="stylesheet" />
	<script src="/assets_client/js/pace.min.js"></script>
	<link href="/assets_client/css/bootstrap.min.css" rel="stylesheet">
	<link href="/assets_client/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link href="/assets_client/css/app.css" rel="stylesheet">
	<link href="/assets_client/css/icons.css" rel="stylesheet">
	<title>Đăng Ký</title>
	<style>
		/* Trang Đăng ký – cùng phong cách Login, giao diện chuyên nghiệp */
		.client-register-page { min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Be Vietnam Pro', sans-serif; background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%); padding: 2rem 1rem; }
		.client-register-page .register-card {
			background: #fff; border-radius: 16px; border: 1px solid #e2e8f0;
			box-shadow: 0 4px 6px -1px rgba(0,0,0,0.06), 0 10px 20px -4px rgba(0,0,0,0.08);
			overflow: hidden; max-width: 420px; width: 100%;
		}
		.client-register-page .register-card .card-body { padding: 2.25rem 2rem; }
		.client-register-page .register-card .form-label { font-weight: 600; color: #1e293b; font-size: 0.875rem; margin-bottom: 0.35rem; }
		.client-register-page .register-card .form-control {
			border-radius: 10px; border: 1px solid #e2e8f0; padding: 0.625rem 0.875rem; font-size: 0.9375rem;
			transition: border-color 0.2s, box-shadow 0.2s;
		}
		.client-register-page .register-card .form-control::placeholder { color: #94a3b8; }
		.client-register-page .register-card .form-control:focus { border-color: #1e293b; box-shadow: 0 0 0 3px rgba(30,41,59,0.12); outline: 0; }
		.client-register-page .register-card .input-group-text {
			border-radius: 0 10px 10px 0; border: 1px solid #e2e8f0; border-left: 0; background: #fff; cursor: pointer; color: #64748b;
		}
		.client-register-page .register-card .input-group .form-control { border-radius: 10px 0 0 10px; }
		.client-register-page .register-card .input-group .form-control:last-child { border-radius: 0 10px 10px 0; border-left: 0; }
		.client-register-page .register-card .input-group.has-toggle .form-control { border-radius: 10px 0 0 10px; }
		.client-register-page .btn-register {
			background: #1e293b; border: none; border-radius: 10px; padding: 0.7rem 1.25rem; font-weight: 600; font-size: 0.9375rem;
			transition: background 0.2s, transform 0.05s;
		}
		.client-register-page .btn-register:hover { background: #0f172a; color: #fff; }
		.client-register-page .btn-register:active { transform: scale(0.99); }
		.client-register-page .btn-social {
			border-radius: 10px; padding: 0.55rem 0.875rem; font-size: 0.875rem; font-weight: 500;
			border: 1px solid #e2e8f0; background: #fff; color: #475569; transition: background 0.2s, border-color 0.2s;
		}
		.client-register-page .btn-social:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e293b; }
		.client-register-page .register-title { font-size: 1.5rem; font-weight: 700; color: #0f172a; margin-bottom: 0.25rem; letter-spacing: -0.02em; }
		.client-register-page .register-sub { color: #64748b; font-size: 0.875rem; margin-bottom: 1.5rem; }
		.client-register-page .divider { display: flex; align-items: center; gap: 1rem; margin: 1.25rem 0; color: #94a3b8; font-size: 0.8125rem; font-weight: 500; }
		.client-register-page .divider::before, .client-register-page .divider::after { content: ''; flex: 1; height: 1px; background: #e2e8f0; }
		.client-register-page .logo-wrap { text-align: center; margin-bottom: 1.25rem; }
		.client-register-page .logo-wrap img { max-width: 140px; height: auto; }
		.client-register-page .link-login { color: #1e293b; font-weight: 600; text-decoration: none; }
		.client-register-page .link-login:hover { color: #0f172a; text-decoration: underline; }
	</style>
</head>

<body class="bg-login">
	<div class="wrapper">
		<div class="client-register-page">
			<div class="register-card card">
				<div class="card-body">
					<div class="logo-wrap">
						<img src="/assets_client/images/logo.jpg" class="rounded-circle w-25 h-25" alt="Logo" />
					</div>
					<h2 class="register-title text-center">Đăng ký</h2>
					<p class="register-sub text-center">Điền thông tin để tạo tài khoản.</p>

					<form class="row g-3" method="POST" action="{{ url('/user/register') }}">
						@csrf
						<div class="col-12">
							<label for="inputName" class="form-label">Họ tên <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="inputName" name="name" placeholder="vd: Nguyễn Văn A" value="{{ old('name') }}" required>
							@error('name')<small class="text-danger">{{ $message }}</small>@enderror
						</div>
						<div class="col-12">
							<label for="inputEmail" class="form-label">Email <span class="text-danger">*</span></label>
							<input type="email" class="form-control" id="inputEmail" name="email" placeholder="vd: email@example.com" value="{{ old('email') }}" required>
							@error('email')<small class="text-danger">{{ $message }}</small>@enderror
						</div>
						<div class="col-12">
							<label for="inputPassword" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
							<div class="input-group has-toggle" id="show_hide_password">
								<input type="password" class="form-control border-end-0" id="inputPassword" name="password" placeholder="Tối thiểu 6 ký tự" required>
								<a href="javascript:;" class="input-group-text bg-transparent" tabindex="-1"><i class="bx bx-hide"></i></a>
							</div>
							@error('password')<small class="text-danger">{{ $message }}</small>@enderror
						</div>
						<div class="col-12">
							<label for="inputPasswordConfirm" class="form-label">Xác nhận mật khẩu <span class="text-danger">*</span></label>
							<div class="input-group has-toggle" id="show_hide_password_confirm">
								<input type="password" class="form-control border-end-0" id="inputPasswordConfirm" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>
								<a href="javascript:;" class="input-group-text bg-transparent" tabindex="-1"><i class="bx bx-hide"></i></a>
							</div>
						</div>
						<div class="col-12 pt-2">
							<button type="submit" class="btn btn-primary btn-register w-100"><i class="bx bx-user-plus me-1"></i>Đăng ký</button>
							<button type="button" class="btn btn-outline-secondary w-100 mt-2" onclick="window.location.href='{{ url('/') }}'">Quay lại trang chủ</button>
						</div>
					</form>
					<div class="text-center pt-3 mt-2 border-top">
						<span class="text-muted small">Đã có tài khoản?</span>
						<a class="link-login ms-1" href="{{ url('/user/login') }}">Đăng nhập</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="/assets_client/js/bootstrap.bundle.min.js"></script>
	<script src="/assets_client/js/jquery.min.js"></script>
	<script src="/assets_client/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="/assets_client/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="/assets_client/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script>
		$(document).ready(function () {
			function togglePassword(selector) {
				$(selector + ' a').on('click', function (e) {
					e.preventDefault();
					var inp = $(selector + ' input');
					var icon = $(selector + ' i');
					if (inp.attr('type') === 'text') {
						inp.attr('type', 'password');
						icon.addClass('bx-hide').removeClass('bx-show');
					} else {
						inp.attr('type', 'text');
						icon.removeClass('bx-hide').addClass('bx-show');
					}
				});
			}
			togglePassword('#show_hide_password');
			togglePassword('#show_hide_password_confirm');
		});
	</script>
	<script src="/assets_client/js/app.js"></script>
</body>

</html>
