<!DOCTYPE html>
<html lang="en">
    @include('admin::layouts.head')
    <body>
        @yield('content')

        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/admin.js') }}"></script> --}}
    </body>
    @include('admin::layouts.scripts')
    @yield('script')
</html>
