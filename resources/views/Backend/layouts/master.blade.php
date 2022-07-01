<!DOCTYPE html>
<html lang="en">

@include('Backend.layouts.head')
<body>

<div class="layout-wrapper layout-content-navbar  ">
    <div class="layout-container">
        @include('Backend.layouts.sidebar')
        <div class="layout-page">
            @include('Backend.layouts.topbar')
            <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    @include('Backend.layouts.footer')
                    <div class="content-backdrop fade"></div>
                </div>
        </div>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
</div>
@include('backend.layouts.javascripts')
@yield('javascript')
@include('backend.layouts.notification')
</body>

</html>
