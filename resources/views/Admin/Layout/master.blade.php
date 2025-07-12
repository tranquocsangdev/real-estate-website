<!DOCTYPE html>
<html lang="en">

<head>
    @include('Admin.Layout.css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="/assets_admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
        </div> --}}

        <!-- Navbar -->
        @include('Admin.Layout.top')

        @include('Admin.Layout.menu')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid" id="app">
                    @yield('content')
                </div>
            </section>
        </div>
        @include('Admin.Layout.footer')

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    @include('Admin.Layout.js')
    @yield('js')
</body>

</html>
