<!doctype html>
<html lang="en">

<head>
    @include('Admin.Layout.css')
</head>

<body>
    <div class="wrapper">
        <div class="header-wrapper">
            @include('Admin.Layout.top')
            @include('Admin.Layout.menu')
        </div>
        <div class="page-wrapper">
            <div class="page-content" id="app">
                @yield('content')
            </div>
        </div>
        <div class="overlay toggle-icon"></div> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        @include('Admin.Layout.footer')
    </div>
    @include('Admin.Layout.switcher')
    @include('Admin.Layout.js')
    @yield('js')
</body>

</html>
