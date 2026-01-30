<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{ setting('meta_description') }}">
<meta name="keywords" content="{{ setting('meta_keywords') }}">
<meta name="author" content="{{ setting('site_name') }}">
<!--favicon-->
@vite('resources/js/app.js')
<link rel="icon" href="{{ setting('favicon') }}" type="image/png" />
<!--plugins-->
<link href="/assets_client/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
<link href="/assets_client/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
<link href="/assets_client/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
<link href="/assets_client/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
<!-- loader-->
<link href="/assets_client/css/pace.min.css" rel="stylesheet" />
<script src="/assets_client/js/pace.min.js"></script>
<!-- Bootstrap CSS -->
<link href="/assets_client/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets_client/css/bootstrap-extended.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<link href="/assets_client/css/app.css" rel="stylesheet">
<link href="/assets_client/css/icons.css" rel="stylesheet">
<!-- Theme Style CSS -->
<link rel="stylesheet" href="/assets_client/css/dark-theme.css" />
<link rel="stylesheet" href="/assets_client/css/semi-dark.css" />
<link rel="stylesheet" href="/assets_client/css/header-colors.css" />
<title>@yield('title') - {{ setting('site_name') }}</title>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
    integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script src="https://balkan.app/js/OrgChart.js"></script>
<!-- Lightbox CSS -->
<link href="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/css/lightbox.min.css" rel="stylesheet">
{{-- Zoome ảnh --}}
<script src="https://cdn.jsdelivr.net/npm/medium-zoom@1.0.6/dist/medium-zoom.min.js"></script>
