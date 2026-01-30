<!doctype html>
<html lang="en">

<head>
    @include('Client.Layout.css')
</head>

<body>
    <div class="wrapper">
        <div class="header-wrapper">
            @include('Client.Layout.top')
            @include('Client.Layout.menu')
        </div>
        <div class="page-wrapper">
            <div class="page-content" id="app">
                @yield('content')
            </div>
        </div>
        <div class="overlay toggle-icon"></div> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        @include('Client.Layout.footer')
    </div>
    @include('Client.Layout.switcher')
    @include('Client.Layout.js')
    @yield('js')
</body>

</html>
