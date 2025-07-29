<!DOCTYPE html>
<html lang="en">

<head>
    @include('Client.Layout.css')
</head>

<body>

    <!-- LOADER -->
    <div class="preloader">
        <div class="lds-ellipsis">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- END LOADER -->

    <!-- START HEADER -->
    <header class="header_wrap fixed-top header_with_topbar">
        @include('Client.Layout.top')
        @include('Client.Layout.menu')
    </header>
    <div class="main_content">
        <div class="section pb_20">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>
    @include('Client.Layout.footer')

    <a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>

    @include('Client.Layout.js')
    @yield('js')

</body>

</html>
