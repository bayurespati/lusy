<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    @stack('title')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Our Custom CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    @stack('additional_css')
</head>

<body>
    <!-- <div class="wrapper"> -->
        <!-- Sidebar  -->
        @yield('content')
    <!-- </div> -->


    <script src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

    @stack('additional_js')
</body>
</html>