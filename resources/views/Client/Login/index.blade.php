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
	<title>Đăng Nhập</title>
	<style>
		/* Trang Login – chỉ form đăng nhập, giao diện chuyên nghiệp */
		.client-login-page { min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Be Vietnam Pro', sans-serif; background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%); padding: 2rem 1rem; }
		.client-login-page .login-card {
			background: #fff; border-radius: 16px; border: 1px solid #e2e8f0;
			box-shadow: 0 4px 6px -1px rgba(0,0,0,0.06), 0 10px 20px -4px rgba(0,0,0,0.08);
			overflow: hidden; max-width: 400px; width: 100%;
		}
		.client-login-page .login-card .card-body { padding: 2.25rem 2rem; }
		.client-login-page .login-card .form-label { font-weight: 600; color: #1e293b; font-size: 0.875rem; margin-bottom: 0.35rem; }
		.client-login-page .login-card .form-control {
			border-radius: 10px; border: 1px solid #e2e8f0; padding: 0.625rem 0.875rem; font-size: 0.9375rem;
			transition: border-color 0.2s, box-shadow 0.2s;
		}
		.client-login-page .login-card .form-control::placeholder { color: #94a3b8; }
		.client-login-page .login-card .form-control:focus { border-color: #1e293b; box-shadow: 0 0 0 3px rgba(30,41,59,0.12); outline: 0; }
		.client-login-page .login-card #show_hide_password .input-group-text {
			border-radius: 0 10px 10px 0; border: 1px solid #e2e8f0; border-left: 0; background: #fff; cursor: pointer; color: #64748b;
		}
		.client-login-page .login-card #show_hide_password input { border-radius: 10px 0 0 10px; }
		.client-login-page .btn-login {
			background: #1e293b; border: none; border-radius: 10px; padding: 0.7rem 1.25rem; font-weight: 600; font-size: 0.9375rem;
			transition: background 0.2s, transform 0.05s;
		}
		.client-login-page .btn-login:hover { background: #0f172a; color: #fff; }
		.client-login-page .btn-login:active { transform: scale(0.99); }
		.client-login-page .btn-social {
			border-radius: 10px; padding: 0.55rem 0.875rem; font-size: 0.875rem; font-weight: 500;
			border: 1px solid #e2e8f0; background: #fff; color: #475569; transition: background 0.2s, border-color 0.2s;
		}
		.client-login-page .btn-social:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e293b; }
		.client-login-page .login-title { font-size: 1.5rem; font-weight: 700; color: #0f172a; margin-bottom: 0.25rem; letter-spacing: -0.02em; }
		.client-login-page .login-sub { color: #64748b; font-size: 0.875rem; margin-bottom: 1.5rem; }
		.client-login-page .divider { display: flex; align-items: center; gap: 1rem; margin: 1.25rem 0; color: #94a3b8; font-size: 0.8125rem; font-weight: 500; }
		.client-login-page .divider::before, .client-login-page .divider::after { content: ''; flex: 1; height: 1px; background: #e2e8f0; }
		.client-login-page .link-forgot { color: #475569; font-weight: 500; font-size: 0.875rem; text-decoration: none; }
		.client-login-page .link-forgot:hover { color: #1e293b; }
		.client-login-page .logo-wrap { text-align: center; margin-bottom: 1.25rem; }
		.client-login-page .logo-wrap img { max-width: 140px; height: auto; }
		.client-login-page .form-check-label { font-size: 0.875rem; color: #475569; }
		.client-login-page .link-register { color: #1e293b; font-weight: 600; text-decoration: none; }
		.client-login-page .link-register:hover { color: #0f172a; text-decoration: underline; }
	</style>
</head>

<body class="bg-login">
	<div class="wrapper">
		<div class="client-login-page">
			<div class="login-card card">
				<div class="card-body">
					<div class="logo-wrap">
						<img src="/assets_client/images/logo.jpg" class="rounded-circle w-25 h-25" alt="Logo" />
					</div>
					<h2 class="login-title text-center">Đăng nhập</h2>
						<p class="login-sub text-center">Nhập email và mật khẩu để tiếp tục.</p>

						<div class="d-grid gap-2 mb-3">
							<a class="btn btn-social" href="javascript:;"><i class="bx bxl-google me-2"></i>Đăng nhập với Google</a>
						</div>
						<div class="divider">hoặc đăng nhập bằng email</div>

						<form class="row g-3" method="POST" action="">
							@csrf
							<div class="col-12">
								<label for="inputEmailAddress" class="form-label">Email</label>
								<input type="email" class="form-control" id="inputEmailAddress" name="email" placeholder="vd: email@example.com" required>
							</div>
							<div class="col-12">
								<label for="inputChoosePassword" class="form-label">Mật khẩu</label>
								<div class="input-group" id="show_hide_password">
									<input type="password" class="form-control border-end-0" id="inputChoosePassword" name="password" placeholder="Nhập mật khẩu">
									<a href="javascript:;" class="input-group-text bg-transparent" tabindex="-1"><i class="bx bx-hide"></i></a>
								</div>
							</div>
							<div class="col-6">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="remember" id="flexSwitchCheckChecked" value="1">
									<label class="form-check-label" for="flexSwitchCheckChecked">Ghi nhớ đăng nhập</label>
								</div>
							</div>
							<div class="col-6 text-end">
								<a class="link-forgot" href="#">Quên mật khẩu?</a>
							</div>
							<div class="col-12 pt-2">
								<button type="submit" class="btn btn-primary btn-login w-100"><i class="bx bxs-lock-open me-1"></i>Đăng nhập</button>
								<button type="button" class="btn btn-outline-secondary w-100 mt-2" onclick="window.location.href='{{ url('/') }}'">Quay lại trang chủ</button>
							</div>
							<div class="col-12 text-center pt-2">
								<span class="text-muted small">Chưa có tài khoản?</span>
								<a class="link-register ms-1" href="{{ url('/user/register') }}">Đăng ký</a>
							</div>
						</form>
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
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide").removeClass("bx-show");
				} else {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide").addClass("bx-show");
				}
			});
		});
	</script>
	<script src="/assets_client/js/app.js"></script>
</body>

</html>
