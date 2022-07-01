<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "newestOnTop":true,
        "showDuration": "1000",
        "hideDuration": "1000",
        "progressBar":true,
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
@if (\Session::has('message'))
    @php $message = \Session::get('message'); @endphp
    <script>
        toastr.{{ $message['status'] }}('{{ $message['msg'] }}');
    </script>
@endif

@if (\Session::has('success'))
    <script>
        toastr.success('{{ \Session::get('success') }}');
    </script>
@endif

@if (\Session::has('warning'))
    <script>
        toastr.warning('{{ \Session::get('warning') }}');
    </script>
@endif

@if (\Session::has('info'))
    <script>
        toastr.info('{{ \Session::get('info') }}');
    </script>
@endif

@if (\Session::has('error'))
    <script>
        toastr.error('{{ \Session::get('error') }}');
    </script>
@endif
